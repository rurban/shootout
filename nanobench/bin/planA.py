# The Computer Language Benchmarks Game
# $Id: planA.py,v 1.3 2008-07-25 01:57:33 igouy-guest Exp $

"""
measure with libgtop2
"""
__author__ =  'Isaac Gouy'


import os, sys, cPickle, time, threading, signal, gtop

from errno import ENOENT
from subprocess import Popen
from measurement import Measurement


def measure(arg,commandline,delay,maxtime,outFile=None,errFile=None,inFile=None):
   r,w = os.pipe()
   forkedPid = os.fork()

   if forkedPid: # read pickled measurements from the pipe
      os.close(w); rPipe = os.fdopen(r); r = cPickle.Unpickler(rPipe)
      measurements = r.load()
      rPipe.close()
      os.waitpid(forkedPid,0)
      return measurements

   else: 
      # Sample thread will be destroyed when the forked process _exits
      class Sample(threading.Thread):
         def __init__(self,program):
            threading.Thread.__init__(self)
            self.setDaemon(1)
            self.p = program
            self.maxMem = 0
            self.timedout = False     
            self.start()      
         def run(self):
            try:
               remaining = maxtime
               while remaining > 0:
                  mem = gtop.proc_mem(self.p).resident
                  self.maxMem = max(mem/1024, self.maxMem)
                  time.sleep(delay)
                  remaining -= delay
               else:
                  self.timedout = True
                  os.kill(self.p, signal.SIGTERM)
                  #os.kill(self.p, signal.SIGKILL)   
            except KeyboardInterrupt:
               raise
               sys.exit(1)

      try:
         m = Measurement(arg)

         # only write pickles to the pipe
         os.close(r); wPipe = os.fdopen(w, 'w'); w = cPickle.Pickler(wPipe)

         # gtop cpu is since machine boot, so we need a before measurement
         cpus0 = gtop.cpu().cpus 

         try:
            # spawn the program in a separate process
            p = Popen(commandline,stdout=outFile,stderr=errFile,stdin=inFile)

            # start a thread to sample the program's resident memory use
            t = Sample( program = p.pid )

            # wait for program exit status and resource usage
            rusage = os.wait3(0)

         except (OSError,ValueError), (e,err):
            if e == ENOENT: # No such file or directory
               print err, commandline,
            else:
               m.setError()            

         else:
            # gtop cpu is since machine boot, so we need an after measurement
            cpus1 = gtop.cpu().cpus 

            # summarize measurements 
            if t.timedout:
               m.setTimedout()
            elif rusage[1] == os.EX_OK:
               m.setOkay()
            else:
               m.setError()

            m.userSysTime = rusage[2][0] + rusage[2][1]
            m.maxMem = t.maxMem

            try:
               load = map( 
                  lambda t0,t1: 
                     int(round( 
                        100.0 * (1.0 - float(t1.idle-t0.idle)/(t1.total-t0.total))
                     ))
                  ,cpus0 ,cpus1 )

               load.sort(reverse=1)
               m.load = ("% ".join([str(i) for i in load]))+"%"

            except ZeroDivisionError: 
               pass # too fast to measure
   
         finally:
            w.dump(m)
            wPipe.close()

         # Sample thread will be destroyed when the forked process _exits
         os._exit(0)

      except KeyboardInterrupt:
         sys.exit(1)
