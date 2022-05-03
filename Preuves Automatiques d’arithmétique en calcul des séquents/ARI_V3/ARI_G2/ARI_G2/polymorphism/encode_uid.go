/*******************/
/*  encode_uid.go  */
/*******************/

package polymorphism

/**
 * This file declares utilities functions to calculate the uid of a type scheme.
 * Unique identifiers are needed to quickly verify if a typescheme is equal to another.
 **/

const (
	ETypeHint  = iota
	ETypeCross = iota
	ETypeArrow = iota
)

/* Encodes the type wanted. On error, returns 0. */
func encode(uids []uint64, typeEncoded int) uint64 {
	tmp := append(uids[:0:0], uids...)
	switch typeEncoded {
	case ETypeHint:
		return encodePair(0, tmp[0])
	case ETypeCross:
		return encodeInt(int64(encodeList(tmp)))
	case ETypeArrow:
		return encodeInt(-int64(encodeList(tmp)))
	}
	return 0
}

/* Encodes a list of identifiers to a new unique identifier. */
func encodeList(uids []uint64) uint64 {
	res := uids[0]
	for i := 1; i < len(uids); i++ {
		res = encodePair(res, uids[i])
	}
	return res
}

/* Encodes a pair following Szudzik's function. */
func encodePair(x uint64, y uint64) uint64 {
	if y > x {
		return y*y + x
	} else {
		return x*x + x + y
	}
}

/* Encodes an integer to a natural number. */
func encodeInt(x int64) uint64 {
	if x >= 0 {
		return 2 * uint64(x)
	} else {
		return 2*uint64(-x) - 1
	}
}
