@csrf
<div class="mb-3">
<label for="nim" class="form-label">NIM</label>
<input type="text" name="nim" id="nim" class="form-control @error('nim') is-invalid @enderror" value="{{ old('nim',$student->nim ?? '') }}" required>
@error('nim') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>


<div class="mb-3">
<label for="name" class="form-label">Nama</label>
<input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name',$student->name ?? '') }}" required>
@error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>


<div class="row">
<div class="col-md-6 mb-3">
<label for="email" class="form-label">Email</label>
<input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email',$student->email ?? '') }}" required>
@error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>


<div class="col-md-3 mb-3">
<label for="year" class="form-label">Angkatan (YYYY)</label>
<input type="text" name="year" id="year" class="form-control @error('year') is-invalid @enderror" value="{{ old('year',$student->year ?? '') }}">
@error('year') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>


<div class="col-md-3 mb-3">
<label for="phone" class="form-label">No. HP</label>
<input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone',$student->phone ?? '') }}">
@error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>
</div>


<div class="mb-3">
<label for="major" class="form-label">Jurusan / Program Studi</label>
<input type="text" name="major" id="major" class="form-control" value="{{ old('major',$student->major ?? '') }}">
</div>


<div class="mb-3">
<label for="address" class="form-label">Alamat</label>
<textarea name="address" id="address" class="form-control" rows="3">{{ old('address',$student->address ?? '') }}</textarea>
</div>