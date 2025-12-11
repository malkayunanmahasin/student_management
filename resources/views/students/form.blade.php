<div class="form-group">
    <label>NIM</label>
    <input type="text" name="nim" class="form-control" value="{{ old('nim', $student->nim ?? '') }}" required>
</div>

<div class="form-group">
    <label>Nama</label>
    <input type="text" name="nama" class="form-control" value="{{ old('nama', $student->nama ?? '') }}" required>
</div>

<div class="form-group">
    <label>Jurusan</label>
    <input type="text" name="jurusan" class="form-control" value="{{ old('jurusan', $student->jurusan ?? '') }}" required>
</div>

<div class="form-group mb-3">
    <label for="angkatan">Angkatan</label>
    <input type="text" class="form-control" name="angkatan" id="angkatan" required>
</div>

<div class="form-group">
    <label>Email</label>
    <input type="email" name="email" class="form-control" value="{{ old('email', $student->email ?? '') }}" required>
</div>

<div class="form-group">
    <label>Telepon</label>
    <input type="text" name="telepon" class="form-control" value="{{ old('telepon', $student->telepon ?? '') }}">
</div>
