# Dokumentasi API

1. **GET** `/visualization`
    Untuk menampilkan halaman mapping, bisa langsung dibuka via browser

2. **GET** `/coordinates`
    Untuk mendapatkan koordinat Access Point dan semua devices
    Response: **200 OK**
    ```
    {
        "access_points_coords": [
            {
                "x": int: x,
                "y": int: y
            },
            {
                "x": int: x,
                "y": int: y
            },
            {
                "x": int: x,
                "y": int: y
            }
        ],
    "devices_coords": [
            {
                "id": int: id,
                "x": int: x,
                "y": int: y,
                "name": string: name
            },
            .
            .
            .
            .
        ]
    }
    ```
3. **POST** `/devices-coordinates`
    Untuk menyimpan koordinat device saat ini
    Request:
    ```
    {
    	"x" : 21,
    	"y" : 93,
    	"name" : "Rogo"
    }
    ```
    
    Response **201 CREATED**

4. **POST** `/ap-coordinates`
    Untuk menyimpan koordinat semua Access Point

    Request:
    ```
    {
    	"ap1" : {
    		"x": int: x,
    		"y": int: y
    	},
    	"ap2" : {
    		"x": int: x,
    		"y": int: y
    	},
    	"ap3" : {
    		"x": int: x,
    		"y": int: y
    	}
    }
    ```
    
    Response: **201 CREATED**