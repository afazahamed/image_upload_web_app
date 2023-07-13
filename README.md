# Image upload web app backend REST API

- This is a backend part of a image upload application. The main functionality of this application is to upload image and share with others. When a user uploads an image it will give a public URL where it be access to anyone and share with anyone. Also this allows to get the uplaoded images based on the user ip.


  
## API Reference

#### Upload new image

```http
  POST /api/images
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `user_ip`      | `string` | **Required**. user_ip to upload |
| `image_path`   | `file` | **Required**. image file to upload |

##### Response

```javascript
{
    "status": true,
    "message": "Data inserted success",
    "data": {
        "image_path": "1689257703monthly_summary_report_4-2.png",
        "image_extension": "image/png",
        "image_url": "http://127.0.0.1:8000/uploads/1689257703monthly_summary_report_4-2.png",
        "user_ip": "123.888.888.88"
    }
}
```

#### Get all images

```http
  GET /api/images
```
##### Response

```javascript
{
    "status": true,
    "data": [
        {
            "id": 22,
            "user_ip": "123.888.888.88",
            "image_path": "http://127.0.0.1:8000/uploads/1689257703monthly_summary_report_4-2.png"
        },
        {
            "id": 21,
            "user_ip": "123.888.888.12",
            "image_path": "http://127.0.0.1:8000/uploads/16892543442.jpg"
        },
        {
            "id": 19,
            "user_ip": "123.888.888.88",
            "image_path": "http://127.0.0.1:8000/uploads/1688366313Univiser_Introduction_(2)-2.png"
        }
    ]
}
```

#### Get image by ip

```http
  GET /api/images/${ip}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `ip`      | `string` | **Required**. Ip of image to fetch |

##### Response

```javascript
{
    "status": true,
    "data": [
        {
            "id": 22,
            "image_path": "1689257703monthly_summary_report_4-2.png",
            "user_ip": "123.888.888.88",
            "created_at": "2023-07-13T14:15:03.000000Z",
            "updated_at": "2023-07-13T14:15:03.000000Z"
        },
        {
            "id": 19,
            "image_path": "1688366313Univiser_Introduction_(2)-2.png",
            "user_ip": "123.888.888.88",
            "created_at": "2023-07-03T06:38:33.000000Z",
            "updated_at": "2023-07-03T06:38:33.000000Z"
        }
    ]
}
```


#### Delete image by id

```http
  DEL /api/images/${id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `string` | **Required**. Id of image to delete |


##### Response

```javascript
{
    "status": true,
    "message": "Image deleted success"
}
```
