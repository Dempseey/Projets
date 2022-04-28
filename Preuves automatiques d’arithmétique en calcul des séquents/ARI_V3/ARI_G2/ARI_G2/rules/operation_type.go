/****************/
/* operation.go */
/****************/
/**
* This file provides rules to manage the opration data-structure.
**/

package ari

import (
	typing "ARI/polymorphism"
	"ARI/types"
	"fmt"
	"math/big"
)

const (
	EQ int = iota
	NEQ
	LESS
	LESSEQ
	GREAT
	GREATEQ
)

var tInt typing.TypeHint
var tRat typing.TypeHint
var tProp typing.TypeHint
var tIntIntProp typing.TypeScheme
var tRatRatProp typing.TypeScheme
var tIntProp typing.TypeScheme
var tRatProp typing.TypeScheme

type operation struct {
	arg1, arg2 *big.Rat
	operator   int
}

func opToString(i int) string {
	switch i {
	case EQ:
		return "="
	case NEQ:
		return "!="
	case LESS:
		return "<"
	case LESSEQ:
		return "<="
	case GREAT:
		return ">"
	case GREATEQ:
		return ">="
	default:
		return "Operator type unknown"
	}
}

func (or operation) getArg1() *big.Rat {
	return or.arg1
}
func (or operation) getArg2() *big.Rat {
	return or.arg2
}
func (or operation) getOperator() int {
	return or.operator
}
func (or operation) toString() string {
	return or.getArg1().RatString() + " " + opToString(or.getOperator()) + " " + or.getArg2().RatString()
}

func Init() {
	tInt = typing.MkTypeHint("int")
	tRat = typing.MkTypeHint("rat")
	tProp = typing.MkTypeHint("o")
	tIntIntProp = typing.MkTypeArrow(typing.MkTypeCross(tInt, tInt), tProp)
	tRatRatProp = typing.MkTypeArrow(typing.MkTypeCross(tRat, tRat), tProp)
	tIntProp = typing.MkTypeArrow(tInt, tProp)
	tRatProp = typing.MkTypeArrow(tRat, tProp)
}

func checkIntIntToProp(ts typing.TypeScheme) bool {
	return ts.Equals(tIntIntProp)
}

func checkRatRatToProp(ts typing.TypeScheme) bool {
	return ts.Equals(tRatRatProp)
}

func checkIntToProp(ts typing.TypeScheme) bool {
	return ts.Equals(tIntProp)
}

func checkRatToProp(ts typing.TypeScheme) bool {
	return ts.Equals(tRatProp)
}

func checkUnaryArithmeticPredicate(id types.Id) bool {
	s := id.ToString()
	return s == "is_int" || s == "is_rat"
}

func checkBinaryArithmeticPredicate(id types.Id) bool {
	s := id.ToString()
	return id.Equals(types.Id_eq) || id.Equals(types.Id_neq) || s == "less" || s == "lesseq" || s == "great" || s == "greateq"
}

func createOperation(arg1, arg2 types.Term, operator int) operation {
	if v1, v2, err := checkError2Args(arg1, arg2); err != nil {
		fmt.Printf("Error createOperation ")
		return createNullOperation()
	} else {
		return operation{v1, v2, operator}
	}
}

func createNullOperation() operation {
	return operation{zero_rat, zero_rat, -1}
}
