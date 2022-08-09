db = db.getSiblingDB('stplapp');

db.createCollection(
    "stpltable",
    {
       timeseries: {
          timeField: "timestamp",
          metaField: "metadata",
          granularity: "minutes"
       },
       expireAfterSeconds: 31557600
    }
);

db.stpltable.insertMany([
    {
        "metadata": {"codigo": "810005051", "placa": "LQJ9380", "linha": "L3202", "id_migracao_trajeto": "", "sentido": "unico", "trajeto": "L02 - Cordovil x Brás de Pina (Via Rua Suruí)"},
        "timestamp": ISODate(new Date().toISOString()),
        "latitude": -22.80808,
        "longitude": -43.32832,
        "velocidade": 4.0
    },
    {
        "metadata": {"codigo": "810001855", "placa": "LMR2J27", "linha": "L4105", "id_migracao_trajeto": "", "sentido": "unico", "trajeto": "L05 - Boiúna x Taquara"},
        "timestamp": ISODate(new Date().toISOString()),
        "latitude": -22.964589999999998,
        "longitude": -43.406450000000014,
        "velocidade": 14.4456
    },
]);