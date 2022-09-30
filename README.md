Test:
```
// tests/shop.js
import {SortManager, SortObject} from "../infinity-sort.js";
let sortManager = new SortManager(
    new SortObject("Auta", 0, 0, 1), // cars
    new SortObject("Závodní", 1, 1, 2), // race
    new SortObject("Nákladní", 1, 1, 3), // trucks
    new SortObject("Motorky", 0, 0, 4), // motorcycles...
    new SortObject("Enduro", 1, 4, 5),
    new SortObject("Babety", 1, 4, 6),
    new SortObject("Letadla", 0, 0, 7),
    new SortObject("Veřejná", 1, 7, 8),
    new SortObject("Airbus", 2, 8, 9),
    new SortObject("Boieng", 2, 8, 10),
    new SortObject("707", 3, 10, 11),
    new SortObject("SmartWings", 2, 8, 12),
    new SortObject("Lodě", 0, 0, 13)
);
let hierarchy = sortManager.getHierarchy();
let json = JSON.stringify(hierarchy, null, "\t");

console.log(json); // shop.json

```

Output:
```
[
  {
    "name": "Auta",
    "level": 0,
    "parent_id": 0,
    "id": 1,
    "children": [
      {
        "name": "Závodní",
        "level": 1,
        "parent_id": 1,
        "id": 2,
        "children": []
      },
      {
        "name": "Nákladní",
        "level": 1,
        "parent_id": 1,
        "id": 3,
        "children": []
      }
    ]
  },
  {
    "name": "Motorky",
    "level": 0,
    "parent_id": 0,
    "id": 4,
    "children": [
      {
        "name": "Enduro",
        "level": 1,
        "parent_id": 4,
        "id": 5,
        "children": []
      },
      {
        "name": "Babety",
        "level": 1,
        "parent_id": 4,
        "id": 6,
        "children": []
      }
    ]
  },
  {
    "name": "Letadla",
    "level": 0,
    "parent_id": 0,
    "id": 7,
    "children": [
      {
        "name": "Veřejná",
        "level": 1,
        "parent_id": 7,
        "id": 8,
        "children": [
          {
            "name": "Airbus",
            "level": 2,
            "parent_id": 8,
            "id": 9,
            "children": []
          },
          {
            "name": "Boieng",
            "level": 2,
            "parent_id": 8,
            "id": 10,
            "children": []
          },
          {
            "name": "SmartWings",
            "level": 2,
            "parent_id": 8,
            "id": 12,
            "children": []
          }
        ]
      }
    ]
  },
  {
    "name": "Lodě",
    "level": 0,
    "parent_id": 0,
    "id": 13,
    "children": []
  }
]
```