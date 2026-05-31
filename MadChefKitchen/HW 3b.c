#include <stdio.h>
#include <math.h>


int main()
{
	int f_0 = 440;				 //constant
	double a = 1.059463094;			 //twelve equally spaced notes per octave (constant)
	double note;				 //output frequency
	

	printf("key#	frequency [Hz]\n");

	for (int k = -48; k <= 38; k += 1)
	{
		note = f_0 * pow(a, k);
		printf("%3i,	%9.2f\n", k, note);
	}

	getchar();
	return 0;
}