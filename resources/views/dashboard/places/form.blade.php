@csrf

<div class="mb-3">
    <label>Nama Tempat</label>
    <input type="text" name="name" class="form-control"
           value="{{ old('name',$place->name ?? '') }}">
</div>

<div class="mb-3">
    <label>Kategori</label>
    <select name="category" class="form-control">
        <option value="wisata">Wisata</option>
        <option value="kuliner">Kuliner</option>
        <option value="umkm">UMKM</option>
    </select>
</div>

<div class="mb-3">
    <label>Rating</label>
    <input type="number" step="0.1" max="5" name="rating"
           class="form-control"
           value="{{ old('rating',$place->rating ?? '') }}">
</div>

<div class="mb-3">
    <label>Alamat</label>
    <input type="text" name="address" class="form-control">
</div>

<div class="row">
    <div class="col">
        <label>Latitude</label>
        <input type="text" name="lat" class="form-control">
    </div>
    <div class="col">
        <label>Longitude</label>
        <input type="text" name="lng" class="form-control">
    </div>
</div>

<div class="mb-3 mt-3">
    <label>Deskripsi</label>
    <textarea name="description" class="form-control"></textarea>
</div>

<div class="mb-3">
    <label>Map Embed</label>
    <textarea name="map_embed" class="form-control"></textarea>
</div>

<div class="mb-3">
    <label>Gambar</label>
    <input type="file" name="image" class="form-control">
</div>

<button class="btn btn-success">Simpan</button>
