/**********************/
/* operation_rules.go */
/**********************/
/**
* This file provides function to manage rules on operation data strcutre and term
**/

package ari

import (
	typing "ARI/polymorphism"
	"ARI/types"
	"errors"
	"fmt"
	"math"
	"math/big"
	"strconv"
	"strings"
)

var zero_rat = &big.Rat{}

func newRat() *big.Rat {
	return big.NewRat(0, 1)
}

func checkError1Arg(t types.Term) (*big.Rat, error) {
	res, err := evaluateTerm(t)
	if err != nil {
		return zero_rat, errors.New("Error in checkError1Arg")
	}
	return res, nil
}

func checkError2Args(arg1, arg2 types.Term) (*big.Rat, *big.Rat, error) {
	res1, err1 := checkError1Arg(arg1)
	res2, err2 := checkError1Arg(arg2)
	if err1 != nil || err2 != nil || res2 == zero_rat {
		return zero_rat, zero_rat, errors.New("Error in checkError2Args")
	}
	return res1, res2, nil
}

/* Transform a predicate into an operation struct */
func predToOperation(p types.Pred) (operation, error) {
	var arg1, arg2 types.Term
	// Assign var depending the number of args
	switch len(p.GetArgs()) {
	case 1:
		arg1 = p.GetArgs()[0]
	case 2:
		arg1 = p.GetArgs()[0]
		arg2 = p.GetArgs()[1]
	default:
		fmt.Printf("Illegal number of arguments in an artihmetic predicate")
		return createNullOperation(), errors.New("Error in predToOperation")
	}

	// Dans ce cas, on ne peut pas conclure, il faudra demander au simplexe
	if len(arg1.GetMetas()) > 0 || len(arg2.GetMetas()) > 0 {
		return createNullOperation(), errors.New("Error in predToOperation")
	}

	switch p.GetID().GetName() {
	case types.Id_eq.GetName():
		return createOperation(arg1, arg2, EQ), nil
	case types.Id_neq.GetName():
		return createOperation(arg1, arg2, NEQ), nil
	case "less":
		return createOperation(arg1, arg2, LESS), nil
	case "lesseq":
		return createOperation(arg1, arg2, LESSEQ), nil
	case "great":
		return createOperation(arg1, arg2, GREAT), nil
	case "greateq":
		return createOperation(arg1, arg2, GREATEQ), nil
	default:
		fmt.Println("Error parse")
		return createNullOperation(), errors.New("Error in predToOperation")
	}

}

/* Transform a term into an int */
func evaluateTerm(t types.Term) (*big.Rat, error) {
	switch ttypes := t.(type) {
	case types.Fun:
		if len(ttypes.GetArgs()) == 0 {
			n_d := strings.Split(ttypes.GetID().ToString(), "/")
			switch len(n_d) {
			case 1:
				if n_d[0] == "0" {
					return zero_rat, nil
				} else {
					n, err_n := strconv.ParseInt(n_d[0], 10, 64)
					if err_n != nil {
						return zero_rat, err_n
					}
					return big.NewRat(n, 1), nil
				}
			case 2:
				n, err_n := strconv.ParseInt(n_d[0], 10, 64)
				if err_n != nil {
					return zero_rat, err_n
				}
				d, err_d := strconv.ParseInt(n_d[1], 10, 64)
				if err_d != nil {
					return zero_rat, err_d
				}
				return big.NewRat(n, d), nil

			default:
				fmt.Printf("Error termToRat")
			}
		} else {
			if res, err := EvaluateFun(ttypes); err != nil {
				return zero_rat, err
			} else {
				return res, nil
			}
		}
	default:
		return nil, errors.New("error evaluateTerm")
	}

	return nil, errors.New("error evaluateTerm")
}

/* Transform a fun into an int */
/**
* Todo : compléter les TODO
* Remplacer les opération sur les int par les opérations int mais sur un type big.rat
* faire les opération dur les rat
* Les 2 returns sur la dernière ligne, c'est pour qu'ils se sentent moins seuls ?
**/

func checkBinaryArithmeticFun(id types.Id) bool {
	s := id.ToString()
	return  s == "sum" || s == "product" || s == "difference" || s == "quotient" || s == "quotient_e" || s == "quotient_t" || s == "quotient_f" || s == "remainder_e" || s == "remainder_t" || s == "remainder_f"
}

func EvaluateFun(f types.Fun) (*big.Rat, error) {
	var arg1, arg2 types.Term
	arg1 = f.GetArgs()[0]
	if checkBinaryArithmeticFun(f.GetID()) {
		arg2 = f.GetArgs()[1]
	
	}

	switch f.GetID().GetName() {
	case "sum":
		if res1, res2, err := checkError2Args(arg1, arg2); err != nil {
			return zero_rat, err
		} else {
			return newRat().Add(res1, res2), nil
		}
	case "difference":
		if res1, res2, err := checkError2Args(arg1, arg2); err != nil {
			return zero_rat, err
		} else {
			return newRat().Sub(res1, res2), nil
		}
	case "product":
		if res1, res2, err := checkError2Args(arg1, arg2); err != nil {
			return zero_rat, err
		} else {
			return newRat().Mul(res1, res2), nil
		}
	case "quotient":
		switch f.GetTypeHint().UID() {
		case typing.GetTypeScheme("quotient", typing.MkTypeCross(tRat, tRat)).UID():
			if res1, res2, err := checkError2Args(arg1, arg2); err != nil {
				return zero_rat, err
			} else {
				return newRat().Quo(res1, res2), nil
			}
		default:
			return zero_rat, errors.New("error in evaluate : quotient")
		}
	case "quotient_e":
		switch f.GetTypeHint().UID() {
		case typing.GetTypeScheme("quotient_e", typing.MkTypeCross(tInt, tInt)).UID():
			if res1, res2, err := checkError2Args(arg1, arg2); err != nil {
				return zero_rat, err
			} else {
				// TODO : quotien_e on int
				quo := new(big.Int).Div(res1.Num(), res2.Num())
				if (new(big.Int).Div(res1.Num(), res2.Num())).Cmp(big.NewInt(0)) == -1 {
					quo.Add(quo, big.NewInt(-1))
				}
				return big.NewRat(quo.Int64(), 1), nil
			}
		case typing.GetTypeScheme("quotient_e", typing.MkTypeCross(tRat, tRat)).UID():
			if res1, res2, err := checkError2Args(arg1, arg2); err != nil {
				return zero_rat, err
			} else {
				quo := res1
				euc := 0
				if quo.Cmp(zero_rat) == 1 && res2.Cmp(zero_rat) == 1 {
					for quo.Cmp(zero_rat) == 1 {
						quo.Sub(res1, res2)
						euc += 1
					}
				}
				if quo.Cmp(zero_rat) == -1 && res2.Cmp(zero_rat) == 1 {
					for quo.Cmp(zero_rat) == -1 {
						quo.Add(res1, res2)
						euc -= 1
					}
				}
				if quo.Cmp(zero_rat) == 1 && res2.Cmp(zero_rat) == -1 {
					for quo.Cmp(zero_rat) == 1 {
						quo.Add(res1, res2)
						euc -= 1
					}
				}
				if quo.Cmp(zero_rat) == -1 && res2.Cmp(zero_rat) == -1 {
					for quo.Cmp(zero_rat) == -1 {
						quo.Sub(res1, res2)
						euc += 1
					}
					euc -= 1
				}
				return big.NewRat(int64(euc), 1), nil
			}
		default:
			return zero_rat, errors.New("Error in evaluate : quotient_e")
		}
	case "quotient_t":
		if res1, res2, err := checkError2Args(arg1, arg2); err != nil {
			return zero_rat, err
		} else {
			quo := res1.Mul(res1, newRat().Inv(res2))
			return big.NewRat((new(big.Int).Mul(new(big.Int).Quo(quo.Num(), quo.Denom()), quo.Denom())).Int64(), (quo.Denom()).Int64()), nil
		}
	case "quotient_f":
		if res1, res2, err := checkError2Args(arg1, arg2); err != nil {
			return zero_rat, err
		} else {
			quo := res1.Mul(res1, newRat().Inv(res2))
			flooredquo := big.NewRat((new(big.Int).Mul(new(big.Int).Quo(quo.Num(), quo.Denom()), quo.Denom())).Int64(), (quo.Denom()).Int64())
			if quo.Cmp(flooredquo) != 0 && flooredquo.Cmp(zero_rat) == -1 {
				flooredquo.Add(flooredquo, big.NewRat(-1, 1))
			}
			return flooredquo, nil
		}
	case "remainder_e":
		switch f.GetTypeHint().UID() {
		case typing.GetTypeScheme("remainder_e", typing.MkTypeCross(tInt, tInt)).UID():
			if res1, res2, err := checkError2Args(arg1, arg2); err != nil {
				return zero_rat, err
			} else {
				remain := new(big.Int).Mod(res1.Num(), res2.Num())
				if (new(big.Int).Div(res1.Num(), res2.Num())).Cmp(big.NewInt(0)) == -1 {
					remain.Add(remain, res2.Num())
				}
				return big.NewRat(remain.Int64(), 1), nil
			}
		case typing.GetTypeScheme("remainder_e", typing.MkTypeCross(tRat, tRat)).UID():
			if res1, res2, err := checkError2Args(arg1, arg2); err != nil {
				return zero_rat, err
			} else {
				Rquotient_e := types.MakeFun(types.MakerId("quotient_e"), []types.Term{arg1, arg2}, typing.GetTypeScheme("quotient_e", typing.MkTypeCross(tRat, tRat)))
				quotient_e, _ := EvaluateFun(Rquotient_e)
				rem := newRat().Set(newRat().Add(res1, newRat().Neg(newRat().Mul(res2, quotient_e))))
				return rem, nil
			}
		default:
			return zero_rat, errors.New("Error in evaluate : remainder_e")
		}
	case "remainder_t":
		switch f.GetTypeHint().UID() {
		case typing.GetTypeScheme("remainder_t", typing.MkTypeCross(tInt, tInt)).UID():
			if res1, res2, err := checkError2Args(arg1, arg2); err != nil {
				return zero_rat, err
			} else {
				// TODO : remainder_t on int
				mod := big.NewRat(new(big.Int).Neg(new(big.Int).Mod(res1.Num(), res2.Num())).Int64(), 1)
				if !((res1.Cmp(zero_rat) == -1 || res2.Cmp(zero_rat) == -1) && !(res1.Cmp(zero_rat) == -1 && res2.Cmp(zero_rat) == -1)) {
					mod.Neg(mod)
				}
				return mod, nil
			}
		case typing.GetTypeScheme("remainder_t", typing.MkTypeCross(tRat, tRat)).UID():
			if res1, res2, err := checkError2Args(arg1, arg2); err != nil {
				return zero_rat, err
			} else {
				Rquotient_t := types.MakeFun(types.MakerId("quotient_t"), []types.Term{arg1, arg2}, typing.GetTypeScheme("quotient_t", typing.MkTypeCross(tRat, tRat)))
				quotient_t, _ := EvaluateFun(Rquotient_t)
				rem := newRat().Set(newRat().Add(res1, newRat().Neg(newRat().Mul(res2, quotient_t))))
				return rem, nil
			}
		default:
			return zero_rat, errors.New("Error in evaluate : remainder_t")
		}
	case "remainder_f":
		switch f.GetTypeHint().UID() {
		case typing.GetTypeScheme("remainder_f", typing.MkTypeCross(tInt, tInt)).UID():
			if res1, res2, err := checkError2Args(arg1, arg2); err != nil {
				return zero_rat, err
			} else {
				// TODO : remainder_f on int
				//peut être faire ça sur chaque remainder ? -> Julie : oui, ça peut être une bonne idée ?
				Rquotient_f := types.MakeFun(types.MakerId("quotient_f"), []types.Term{arg1, arg2}, typing.GetTypeScheme("quotient_f", typing.MkTypeCross(tInt, tInt)))
				quotient_f, _ := EvaluateFun(Rquotient_f)
				return big.NewRat((new(big.Int).Sub(res1.Num(), new(big.Int).Mul(res2.Num(), quotient_f.Num()))).Int64(), 1), nil
			}
		case typing.GetTypeScheme("remainder_f", typing.MkTypeCross(tRat, tRat)).UID():
			if res1, res2, err := checkError2Args(arg1, arg2); err != nil {
				return zero_rat, err
			} else {
				Rquotient_f := types.MakeFun(types.MakerId("quotient_f"), []types.Term{arg1, arg2}, typing.GetTypeScheme("quotient_f", typing.MkTypeCross(tRat, tRat)))
				quotient_f, _ := EvaluateFun(Rquotient_f)
				rem := newRat().Set(newRat().Add(res1, newRat().Neg(newRat().Mul(res2, quotient_f))))
				return rem, nil
			}
		default:
			return zero_rat, errors.New("Error in evaluate : remainder_f")
		}
	case "uminus":
		switch f.GetTypeHint() {
		case tInt, tRat:
			if res1, err := checkError1Arg(arg1); err != nil {
				fmt.Println("je passe ici? ")
				return zero_rat, err
			} else {
				if res1 == zero_rat {
					return zero_rat, nil
				} else {
					return newRat().Mul(res1, newRat().SetInt(big.NewInt(-1))), nil
				}
			}
		default:
			fmt.Println("suis-je arrivé ici? ")

			return zero_rat, errors.New("Error in evaluate : uminus")
		}
	// Pour les cas suivants, je regroupe tout en un cas car les opérations sont les memes
	case "floor":
		switch f.GetTypeHint() {
		case tInt, tRat:
			if res1, err := checkError1Arg(arg1); err != nil {
				return zero_rat, err
			} else {
				res_1_f64, _ := res1.Float64()
				return newRat().SetFloat64(math.Floor(res_1_f64)), nil
			}
		default:
			return zero_rat, errors.New("Error in evaluate : floor")
		}
	case "ceiling":

		switch f.GetTypeHint() {
		case tInt, tRat:
			if res1, err := checkError1Arg(arg1); err != nil {
				return zero_rat, err
			} else {
				res_1_f64, _ := res1.Float64()
				return newRat().SetFloat64(math.Ceil(float64(res_1_f64))), nil
			}
		default:
			return zero_rat, errors.New("Error in evaluate : floor")
		}
	case "truncate":
		switch f.GetTypeHint() {
		case tInt, tRat:
			if res1, err := checkError1Arg(arg1); err != nil {
				return zero_rat, err
			} else {
				if res1.Cmp(zero_rat) == 1 {
					res_1_f64, _ := res1.Float64()
					return newRat().SetFloat64(math.Floor(float64(res_1_f64))), nil
				} else {
					// TODO : pas sûre ?
					// pas sur de ça
					res_1_f64, _ := res1.Float64()
					return newRat().SetFloat64(math.Ceil(float64(res_1_f64))), nil
				}
			}

		default:
			return zero_rat, errors.New("Error in evaluate : floor")
		}
	case "round":
		fmt.Println(f.GetTypeHint())
		switch f.GetTypeHint() {
		case tInt:

			if res1, err := checkError1Arg(arg1); err != nil {
				return zero_rat, err
			} else {
				res_1_f64, _ := res1.Float64()
				diff := res_1_f64 - float64(int(res_1_f64))
				res := newRat()

				if diff >= 0.5 {
					res = res.SetFloat64(math.Ceil(float64(res_1_f64)))
				} else {
					res = res.SetFloat64(math.Floor(float64(res_1_f64)))
				}

				return res, nil
				// TODO : ?
				// return res1, nil
				// return res1 - res1%1, nil
			}
		case tRat:
			// TODO : round on rat
			
			if res1, err := checkError1Arg(arg1); err != nil {
				return zero_rat, err
			} else {
				res_1_f64, _ := res1.Float64()
				// Pas sure de moi

				//Rfloor := types.MakeFun(types.MakerId("floor"), []types.Term{arg1}, typing.GetTypeScheme("floor", typing.MkTypeCross(tRat)))
				//floor, _ := FunToRat(Rfloor)
				//return res1 - (res2 * quotient_f), nil

				res_1_f64_floor := newRat().SetFloat64(math.Floor(res_1_f64))
				
				diff := newRat().Sub(res1, res_1_f64_floor)
				res := newRat()

				if diff.Cmp(big.NewRat(1,2)) == 1 || res1.Cmp(big.NewRat(1,2)) == 0 {
					res = res.SetFloat64(math.Ceil(float64(res_1_f64)))
					//return newRat().res.SetFloat64(math.Ceil(float64(res_1_f64)))
				} else {
					res = res.SetFloat64(math.Floor(float64(res_1_f64)))
					//return newRat().SetFloat64(math.Floor(float64(res_1_f64)))
				}
				
				return res, nil
				// TODO : ?
				// return res1, nil
				// return res1 - res1%1, nil
			}
			
		default:
			return zero_rat, errors.New("Error in evaluate : floor")
		}

	default:
		return zero_rat, errors.New("Error in evaluatefun : type of fun unknown")
	}
	return zero_rat, errors.New("Error in evaluate : floor")
}
