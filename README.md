Test:
```
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
```

Output:
```
- Auta 
  - Závodní 
  - Nákladní   
- Motorky
  - Enduro
  - Babety
- Letadla
  - Veřejná    
    - Airbus    
    - Boieng    
    - SmartWings

- Lodě
```