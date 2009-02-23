"* The Computer Language Benchmarks Game
    http://shootout.alioth.debian.org/
    contributed by Andres Valloud *"!


!SequenceableCollection methodsFor: 'computer language shootout'!
substringFrequencies3a: aLength using: aDictionary

   | buffer |
   buffer := String new: aLength.
   1 to: self size - aLength + 1 do:
      [:i |
         | answer |
         buffer replaceFrom: 1 to: aLength with: self startingAt: i.
         answer := aDictionary
            at: buffer
            putValueOf: [:sum | sum + 1]
            ifAbsentPutValueOf: 1.
         answer = 1 ifTrue: [buffer := String new: aLength].
      ].
   ^aDictionary! !


!Dictionary methodsFor: 'computer language shootout'!
at: key putValueOf: putBlock ifAbsentPutValueOf: absentBlock
   "* Set the value at key to be the value of evaluating putBlock
    with the existing value. If key is not found, create a new
    entry for key and set is value to the evaluation of
    absentBlock. Answer the result of evaluating either block. *"

   | index element anObject |
   key == nil ifTrue:
      [^self
         subscriptBoundsErrorFor: #at:putValueOf:ifAbsentPutValueOf:
         index: key
         value: absentBlock value].
   index := self findKeyOrNil: key.
   element := self basicAt: index.
   element == nil
      ifTrue: [self atNewIndex: index put:
         (self createKey: key value: (anObject := absentBlock value))]
      ifFalse: [element value: (anObject := putBlock value: element value)].
   ^anObject ! !


!Tests class methodsFor: 'benchmarking'!
readFasta: sequenceName from: input
   | prefix newline buffer description line char |
   prefix := '>',sequenceName.
   newline := Character cr.

   "* find start of particular fasta sequence *"
   [(input atEnd) or: [
         (input peek = $>)
            ifTrue: [((line := input upTo: newline)
               indexOfSubCollection: prefix startingAt: 1) = 1]
            ifFalse: [input skipThrough: newline. false]]
      ] whileFalse.

   "* line-by-line read - it would be a lot faster to block read *"
   description := line.
   buffer := ReadWriteStream on: (String new: 1028).
   [(input atEnd) or: [(char := input peek) = $>]] whileFalse: [
      (char = $;)
         ifTrue: [input upTo: newline]
         ifFalse: [buffer nextPutAll: (input upTo: newline)]
      ].
   ^Association key: description value: buffer contents ! !


!Tests class methodsFor: 'benchmarking'!
knucleotide4From: input to: output
   "Same as 3a, but presize the frequency dictionary better"

   | sequence writeFrequencies writeCount maxDictionarySize |

   ObjectMemory currentMemoryPolicy
      memoryUpperBound: (640 bitShift: 20);
      growthRegimeUpperBound: (512 bitShift: 20);
      freeMemoryUpperBound: (64 bitShift: 20).

   sequence := (self readFasta: 'THREE' from: input) value asUppercase.

   maxDictionarySize :=  sequence size min: 80000000.

   writeFrequencies :=
      [:k | | frequencies count |
      frequencies := SortedCollection sortBlock: [:a :b|
      (a value = b value) ifTrue: [b key < a key] ifFalse: [b value < a value]].

   count := 0.0.
   (sequence substringFrequencies3a: k using: (Dictionary new: ((4 raisedToInteger: k) * 3 / 2 min: maxDictionarySize)))
      associationsDo: [:each|
         frequencies add: each. count := count + each value].

   frequencies do: [:each | | percentage |
      percentage := (each value / count) * 100.0.
      output
         nextPutAll: each key; space;
         print: percentage digits: 3; nl]].

   writeCount := [:nucleotideFragment | | frequencies count |
      frequencies := sequence substringFrequencies3a: nucleotideFragment size
         using: (Dictionary new: ((4 raisedToInteger: nucleotideFragment size) min: sequence size) * 3 // 2).
      count := frequencies at: nucleotideFragment ifAbsent: [0].
      output print: count; tab; nextPutAll: nucleotideFragment; nl].

   writeFrequencies value: 1. output nl.
   writeFrequencies value: 2. output nl.

   writeCount value: 'GGT'.
   writeCount value: 'GGTA'.
   writeCount value: 'GGTATT'.
   writeCount value: 'GGTATTTTAATT'.
   writeCount value: 'GGTATTTTAATTTATAGT'.! !


!Tests class methodsFor: 'benchmark scripts'!
knucleotide4

   self knucleotide4From: self stdinSpecial to: self stdout.
   ^''! !
