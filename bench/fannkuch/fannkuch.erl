%  The Great Computer Language Shootout
%   http://shootout.alioth.debian.org/
%  
%   contributed by Mark Scandariato
%
%   erl -noshell -noinput -run message main 7

-module(fannkuch).
-export([main/1]).

swap(T, I, J) ->
    T2 = setelement(I, T, element(J, T)),
    setelement(J, T2, element(I, T)).

exch(T, N, C) when N rem 2 == 0 -> swap(T, C, N);
exch(T, N, _) -> swap(T, 1, N).

main([Arg]) ->
    N = list_to_integer(Arg),
    F = main(N),
    io:fwrite("Pfannkuchen(~p) = ~p~n", [N, F]),
    erlang:halt(0);

main(N) when N > 0 ->
    T0 = list_to_tuple(lists:seq(1,N)),
    {F, _} = permute(0, N, N, T0),
    F.

permute(F, L, 1, T) -> {flip(F, L, tuple_to_list(T)), T};
permute(F, L, N, T) -> loop(F, L, N, 1, T).
     
loop(F, _, N, C, T) when C > N -> {F, T};
loop(F, L, N, C, T) ->
    {F2, T2} = permute(F, L, N-1, T),
    loop(F2, L, N, C+1, exch(T2, N, C)). 

flip(F, _, [1|_]) -> F;
flip(F, L, [L|_]) -> F;
flip(F, _, P) -> 
    case flip(P, 0) of
        X when X > F -> X;
        _ -> F
    end.
 
flip([1|_], F) -> F;
flip([I|_]=L, F) ->
    {H, T} = lists:split(I, L),
    flip(lists:reverse(H)++T, F+1).

