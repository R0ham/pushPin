# pushPin API Endpoints

```
GET /
```
Returns the single-page web application

---

```
GET /api/posters?page=i&count=n
```
Returns the i<sup>th</sup> page of n posters.

---

```
PUT /api/posters
JSON body: {
   <tbd>
}
```
Posts a new poster to pushPin

---

```
GET /api/image/:hash
```
Returns the image associated with a hash. Useful for embedding.

More tbd