// $Id: strcat.java2.java,v 1.1 2004-05-23 07:14:28 bfulgham Exp $
// http://www.bagley.org/~doug/shootout/

import java.io.*;
import java.util.*;

public class strcat {
    public static void main(String args[]) throws IOException {
	int n = Integer.parseInt(args[0]);
	String str = "";

	for (int i=0; i<n; i++) {
	    str += "hello\n";
	}

	System.out.println(str.length());
    }
}
