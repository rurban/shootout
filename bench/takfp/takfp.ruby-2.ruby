# The Great Computer Language Shootout
# http://shootout.alioth.debian.org/
#
# Contributed by: Robbert Haarman

def tak x, y, z
	(y >= x) ? z :
		tak(tak(x - 1.0, y, z), tak(y - 1, z, x), tak(z - 1, x, y))
end

N = ARGV[0].to_f || 10.0
puts tak(N * 3.0, N * 2.0, N * 1.0)
