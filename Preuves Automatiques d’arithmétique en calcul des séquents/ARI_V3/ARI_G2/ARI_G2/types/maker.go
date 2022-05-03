/***************/
/* maker.go */
/***************/
/**
* This file provides methods and data for an efficient types management.
**/

package types

import (
	"sync"

	typing "ARI/polymorphism"
)

/* Datas */
var cpt_id int
var cpt_var int

var idTable map[string]int = make(map[string]int)
var idVar map[string]int = make(map[string]int)
var idMeta map[string]int = make(map[string]int)
var lock_id sync.Mutex
var lock_var sync.Mutex
var lock_meta sync.Mutex

// Global id
var Id_eq = MakerId("=")
var Id_neq = MakerId("!=")

/* Reset all the maps and counters */
func Reset() {
	cpt_id = 0
	cpt_var = 0
	idTable = map[string]int{}
	idVar = map[string]int{}
	ResetMeta()
}

/* Reset the metavariable table (useful when the IDDFS stop and restart) */
func ResetMeta() {
	idMeta = map[string]int{}
}

/* ID maker */
func MakerId(s string) Id {
	lock_id.Lock()
	i, ok := idTable[s]
	lock_id.Unlock()
	if ok {
		return MakeId(i, s)
	} else {
		return MakerNewId(s)
	}
}

func MakerNewId(s string) Id {
	lock_id.Lock()
	idTable[s] = cpt_id
	id := MakeId(cpt_id, s)
	cpt_id += 1
	lock_id.Unlock()
	return id
}

/* Var maker */
func MakerVar(s string, t ...typing.TypeScheme) Var {
	lock_var.Lock()
	i, ok := idVar[s]
	lock_var.Unlock()
	if ok {
		return MakeVar(i, s, getType(t))
	} else {
		return MakerNewVar(s, getType(t))
	}
}

func MakerNewVar(s string, t ...typing.TypeScheme) Var {
	lock_var.Lock()
	idVar[s] = cpt_var
	vr := MakeVar(cpt_var, s, getType(t))
	cpt_var += 1
	lock_var.Unlock()
	return vr
}

/* Meta maker */
func MakerMeta(s string, formula int, t ...typing.TypeScheme) Meta {
	lock_meta.Lock()
	i, ok := idMeta[s]
	lock_meta.Unlock()
	if ok {
		lock_meta.Lock()
		idMeta[s] = i + 1
		lock_meta.Unlock()
		return MakeMeta(i, s, formula, getType(t))
	} else {
		lock_meta.Lock()
		idMeta[s] = 1
		lock_meta.Unlock()
		return MakeMeta(0, s, formula, getType(t))
	}
}

/* Const maker (given a id, create a fun without args) */
func MakerConst(id Id, t ...typing.TypeScheme) Fun {
	return MakeFun(id, []Term{}, getType(t))
}

/* Fun maker, with given id and args */
func MakerFun(id Id, terms []Term, t ...typing.TypeScheme) Fun {
	return MakeFun(id, terms, getType(t))
}

func getType(t []typing.TypeScheme) typing.TypeScheme {
	if len(t) == 1 {
		return t[0]
	} else {
		return typing.DefaultType()
	}
}
