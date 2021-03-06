/**************************/
/*  manage_apps_types.go  */
/**************************/

package polymorphism

import (
	"fmt"
	"sync"
)

/**
 * This file contains the logic behind the Type Schemes of polymorphic functions
 * or predicates.
 * A function can have different types of arguments, for example :
 *	sum: int * int > int
 *	sum: rat * rat > rat
 * but both type schemes should be valid, and kept in memory.
 **/

/* Maps an application: input type scheme and output type scheme. */
type App struct {
	in  TypeScheme
	out TypeScheme
	app TypeScheme
}

/* Map of Type Schemes for a function or a predicate. */
var typeSchemesMap struct {
	tsMap map[string][]App
	lock  sync.Mutex
}

/* Saves a TypeScheme in the map of schemes. */
func SaveTypeScheme(name string, in TypeScheme, out TypeScheme) error {
	tArrow := MkTypeArrow(in, out)

	// If the map contains the name of the function/predicate, a type scheme has already been
	// defined for it. It means that the out types shouldn't clash, otherwise, the new type
	// scheme is wrong.
	tScheme, found := getSchemeFromArgs(name, in)
	if tScheme != nil {
		if tScheme.Equals(tArrow) {
			return nil
		}
		// $i-unification
		return fmt.Errorf("trying to save a known type scheme with different return types for the function %s", name)
	}

	// It's not in the map, it should be added
	typeSchemesMap.lock.Lock()
	if found {
		typeSchemesMap.tsMap[name] = append(typeSchemesMap.tsMap[name], App{in: in, out: out, app: tArrow})
	} else {
		typeSchemesMap.tsMap[name] = []App{{in: in, out: out, app: tArrow}}
	}
	typeSchemesMap.lock.Unlock()

	return nil
}

/* Gets a TypeScheme from the map of schemes with the name. */
func GetTypeScheme(name string, inArgs TypeScheme) TypeScheme {
	// fmt.Printf("%v\n", typeSchemesMap.tsMap)
	if tScheme, _ := getSchemeFromArgs(name, inArgs); tScheme != nil {
		return tScheme
	} else {
		// If it's not found, the type is inferred with $i
		return MkTypeArrow(inArgs, MkTypeHint("i"))
	}
}

/* Returns the TypeScheme from the name & inArgs if it exists in the map. Else, nil. true means fun name is in the map. */
func getSchemeFromArgs(name string, inArgs TypeScheme) (TypeScheme, bool) {
	typeSchemesMap.lock.Lock()
	if arr, found := typeSchemesMap.tsMap[name]; found {
		for _, fun := range arr {
			if fun.in.Equals(inArgs) {
				typeSchemesMap.lock.Unlock()
				return fun.app, true
			}
		}
		typeSchemesMap.lock.Unlock()
		return nil, true
	}
	typeSchemesMap.lock.Unlock()
	return nil, false
}
