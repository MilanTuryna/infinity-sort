// DB recursion test, it's used for logical principle, we will use for article categories in the future.
// Example is created by car database.
"use strict";

export class SortObject {
    static properties = Object.getOwnPropertyNames(new SortObject());
    constructor(name, level, parent_id, id) {
        this.name = name;
        this.level = level;
        this.parent_id = parent_id;
        this.id = id;
        this.children = []; // to prevent undefined value
    }
    setChildren(children) {
        this.children = children;
    }

    static createFrom(obj) {
        if(!SortObject.properties.some((el) => Object.getOwnPropertyNames(obj).includes(el))) {
            throw TypeError("Object must have these properties: " + SortObject.properties);
        }
        let sortObject = new SortObject(obj.name, obj.level, obj.parent_id, obj.id);
        Object.entries((key, value) => sortObject[key] = value); // instead {...sortObject, obj} because we need save setChildren() method with object
        return sortObject
    }
}
export class SortManager {
    _createValidObjects() {
        this.rows = this.rows.map(SortObject.createFrom);
    }
    _sort() {
        let levels1 = this.rows.filter(obj => obj.level === 0);
        levels1.forEach(firstLevel => {
            let children = this.rows.filter(obj => obj.parent_id === firstLevel.id);
            let newEntry = SortObject.createFrom(firstLevel);
            children.forEach((cc) => {
                let infinityLevel = (level, otherLevels) => {
                    otherLevels.forEach((obj) => {
                        children[children.indexOf(cc)].children.push(obj)
                        let nextLevel = level+1;
                        infinityLevel(nextLevel, this.rows.filter(obj => obj.level === nextLevel && obj.parent_id === obj.id))
                    })
                }
                infinityLevel(2, this.rows.filter(obj => obj.level === 2 && obj.parent_id === cc.id))
            })
            newEntry.setChildren(children);
            this.sortedRows.push(newEntry);
        })
    }

    constructor(...rows) {
        this.rows = rows;
        this.sortedRows = [];

        this._createValidObjects()
        this._sort();
    }

    getHierarchy() {
        return this.sortedRows;
    }
}