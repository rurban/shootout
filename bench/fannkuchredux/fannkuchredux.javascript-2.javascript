/* The Computer Language Benchmarks Game
   http://shootout.alioth.debian.org/

   contributed by Isaac Gouy, transliterated from Mike Pall's Lua program 
*/

function fannkuch(n) {
   [p, q, s, sign, maxflips, sum, m] = [Array(n), Array(n), Array(n), 1, 0, 0, n-1]
   for(var i=0; i<n; i++){ p[i] = i; q[i] = i; s[i] = i; }
   do {
      // Copy and flip.
      var q0 = p[0];                                     // Cache 0th element.
      if (q0 != 0){
         for(var i=1; i<n; i++) q[i] = p[i];             // Work on a copy.
         var flips = 1;
         do { 
            var qq = q[q0]; 
            if (qq == 0){                                // ... until 0th element is 0.
               sum += sign*flips;
	       if (flips > maxflips) maxflips = flips;   // New maximum?
               break; 
            } 
 	    q[q0] = q0; 
	    if (q0 >= 3){
	       var i = 1, j = q0 - 1, t;
               do { [ q[i],q[j] ] = [ q[j],q[i] ]; i++; j--; } while (i < j); 
            }
	    q0 = qq; flips++;
         } while (true); 
      }
      // Permute.
      if (sign == 1){
         [ p[1],p[0] ] = [ p[0],p[1] ]; sign = -1;       // Rotate 0<-1.
      } else { 
         [ p[1],p[2] ] = [ p[2],p[1] ]; sign = 1;        // Rotate 0<-1 and 0<-1<-2.
         for(var i=2; i<n; i++){ 
	    var sx = s[i];
	    if (sx != 0){ s[i] = sx-1; break; }
	    if (i == m) return [sum,maxflips];           // Out of permutations.
	    s[i] = i;
	    // Rotate 0<-...<-i+1.
	    t = p[0]; for(var j=0; j<=i; j++){ p[j] = p[j+1]; } p[i+1] = t;
         }
      }
   } while (true);
}

var n = 1*arguments[0]*1;
var [checksum,pf] = fannkuch(n);
print(checksum + "\n" + "Pfannkuchen(" + n + ") = " + pf);
