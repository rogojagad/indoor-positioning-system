# About
Created using Phalcon PHP Framework

# Dokumentasi API

1. **GET** `/visualization`
    Untuk menampilkan halaman mapping, bisa langsung dibuka via browser

2. **GET** `/coordinates`
    Untuk mendapatkan koordinat Access Point dan semua devices

    Response: **200 OK**
    ```
    {
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
    	"x" : int: x,
    	"y" : int: y,
    	"name" : string: name
    }
    ```
    
    Response **201 CREATED**