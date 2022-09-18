// DB recursion test, it's used for logical principle, we will use for article categories in the future.
// Example is created by car database.
class SortObject {
    constructor(name, level, parent_id, id) {
        this.name = name;
        this.level = level;
        this.parent_id = parent_id;
        this.id = id;
    }
}

function recursion(database) {
    let firstLevels = database.filter(obj => obj.level === 0);
    firstLevels.forEach(firstLevel => {
        let children = database.filter(obj => obj.parent_id === firstLevel.id);
        console.log(firstLevel.name);
        children.forEach(cc => {
            console.log("- " + cc.name)
            function rec(level, otherLevels) {
                otherLevels.forEach(obj => {
                    console.log("-".repeat(level) + " " + obj.name) // for example '-- Airbus' if level === 2
                    let nextLevel = level+1;
                    rec(nextLevel, database.filter(obj => obj.level === nextLevel && obj.parent_id === obj.id))
                })
            }
            rec(2, database.filter(obj => obj.level === 2 && obj.parent_id === cc.id));
        })
    })
}

// test
let database = [
    new SortObject("Auta", 0, 0, 1),
        new SortObject("Závodní", 1, 1, 2),
        new SortObject("Nákladní", 1, 1, 3),
    new SortObject("Motorky", 0, 0, 4),
        new SortObject("Enduro", 1, 4, 5),
        new SortObject("Babety", 1, 4, 6),
    new SortObject("Letadla", 0, 0, 7),
        new SortObject("Veřejná", 1, 7, 8),
            new SortObject("Airbus", 2, 8, 9),
            new SortObject("Boieng", 2, 8, 10),
                new SortObject("707", 3, 10, 11),
            new SortObject("SmartWings", 2, 8, 12),
    new SortObject("Lodě", 0, 0, 13)
]
recursion(database);


