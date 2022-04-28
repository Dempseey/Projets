/********************/
/*  tptp_native.go  */
/********************/

/**
 * This file declares TPTP native types and types scheme :
 *	- int, rat, real for primitives
 *	- a bunch of type schemes
 **/

package polymorphism

var tInt TypeHint
var tRat TypeHint
var tReal TypeHint
var tProp TypeHint
var defaultType TypeHint

var intCrossInt TypeScheme
var ratCrossRat TypeScheme
var realCrossReal TypeScheme

func initTPTPTypes() {
	defaultType = MkTypeHint("i")
	// Types
	tInt = MkTypeHint("int")
	tRat = MkTypeHint("rat")
	tReal = MkTypeHint("real")
	tProp = MkTypeHint("o")

	intCrossInt = MkTypeCross(tInt, tInt)
	ratCrossRat = MkTypeCross(tRat, tRat)
	realCrossReal = MkTypeCross(tReal, tReal)

	// Schemes
	// 1 - Binary predicates
	recordBinaryProp("less")
	recordBinaryProp("lesseq")
	recordBinaryProp("greater")
	recordBinaryProp("greatereq")

	// 2 - Binary input arguments
	recordBinaryInArgs("sum")
	recordBinaryInArgs("difference")
	recordBinaryInArgs("product")
	recordBinaryInArgs("quotient_e")
	recordBinaryInArgs("quotient_t")
	recordBinaryInArgs("quotient_f")
	recordBinaryInArgs("remainder_e")
	recordBinaryInArgs("remainder_t")
	recordBinaryInArgs("remainder_f")

	// 3 - $quotient
	SaveTypeScheme("quotient", ratCrossRat, tRat)
	SaveTypeScheme("quotient", realCrossReal, tReal)

	// 4 - Unary input arguments
	recordUnaryInArgs("uminus")
	recordUnaryInArgs("floor")
	recordUnaryInArgs("ceiling")
	recordUnaryInArgs("truncate")
	recordUnaryInArgs("round")

	// 5 - Unary predicates
	recordUnaryProp("is_int")
	recordUnaryProp("is_rat")

	// 6 - Conversion
	recordConversion("to_int", tInt)
	recordConversion("to_rat", tRat)
	recordConversion("to_real", tReal)
}

func recordBinaryProp(name string) {
	SaveTypeScheme(name, intCrossInt, tProp)
	SaveTypeScheme(name, ratCrossRat, tProp)
	SaveTypeScheme(name, realCrossReal, tProp)
}

func recordBinaryInArgs(name string) {
	SaveTypeScheme(name, intCrossInt, tInt)
	SaveTypeScheme(name, ratCrossRat, tRat)
	SaveTypeScheme(name, realCrossReal, tReal)
}

func recordUnaryInArgs(name string) {
	SaveTypeScheme(name, tInt, tInt)
	SaveTypeScheme(name, tRat, tRat)
	SaveTypeScheme(name, tReal, tReal)
}

func recordUnaryProp(name string) {
	SaveTypeScheme(name, tInt, tProp)
	SaveTypeScheme(name, tRat, tProp)
	SaveTypeScheme(name, tReal, tProp)
}

func recordConversion(name string, out TypeScheme) {
	SaveTypeScheme(name, tInt, out)
	SaveTypeScheme(name, tRat, out)
	SaveTypeScheme(name, tReal, out)
}

func IsInt(tType TypeScheme) bool  { return tType.Equals(tInt) }
func IsRat(tType TypeScheme) bool  { return tType.Equals(tRat) }
func IsReal(tType TypeScheme) bool { return tType.Equals(tReal) }
func DefaultType() TypeScheme      { return defaultType }

func DefaultFunType(len int) TypeScheme {
	return defaultAppType(len, defaultType)
}

func DefaultPropType(len int) TypeScheme {
	return defaultAppType(len, tProp)
}

func defaultAppType(len int, out TypeScheme) TypeScheme {
	if len == 0 {
		return out
	} else if len == 1 {
		return MkTypeArrow(defaultType, out)
	} else {
		ts := []TypeScheme{}
		for i := 0; i < len; i++ {
			ts = append(ts, defaultType)
		}
		return MkTypeArrow(MkTypeCross(ts...), out)
	}
}
