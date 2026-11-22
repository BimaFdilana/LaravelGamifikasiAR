<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Misi</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f3f4f6; }
        .card { border: none; border-radius: 15px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05); }
        .form-label { font-weight: 500; color: #495057; margin-bottom: 0.5rem; }
        .input-group-text { background-color: #fff; border-right: none; color: #6c757d; }
        .form-control, .form-select { border-left: none; padding: 0.6rem 1rem; }
        .form-control:focus, .form-select:focus { box-shadow: none; border-color: #86b7fe; }
        .input-group > .form-control, .input-group > .form-select, .input-group > .input-group-text { border: 1px solid #ced4da; }
        .input-group > .form-control, .input-group > .form-select { border-left: none; }
        .input-group > .input-group-text { border-right: none; }
    </style>
</head>

<body>
    @include('admin.partials.navbar')

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h3 class="fw-bold text-dark mb-1">Edit Misi</h3>
                        <p class="text-muted small mb-0">Perbarui informasi misi: <strong>{{ $mission->title }}</strong></p>
                    </div>
                    <a href="{{ route('admin.missions.index') }}" class="btn btn-outline-secondary btn-sm"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 mb-4">
                        <ul class="mb-0"> @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="card p-4">
                    <div class="card-body">
                        <form action="{{ route('admin.missions.update', $mission->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-8 mb-4">
                                    <label class="form-label">Judul Misi <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-heading"></i></span>
                                        <input type="text" name="title" value="{{ old('title', $mission->title) }}" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-4">
                                    <label class="form-label">Tipe Misi <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-tags"></i></span>
                                        <select name="type" id="typeSelect" class="form-select" required onchange="toggleFields()">
                                            <option value="building" {{ old('type', $mission->type) == 'building' ? 'selected' : '' }}>Pencarian Gedung (AR)</option>
                                            <option value="quiz" {{ old('type', $mission->type) == 'quiz' ? 'selected' : '' }}>Kuis</option>
                                            <option value="book" {{ old('type', $mission->type) == 'book' ? 'selected' : '' }}>Pencarian Buku (AR, lama)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            {{-- Target AR (disembunyikan jika Kuis) --}}
                            <div class="mb-4 p-4 border rounded bg-white shadow-sm" id="targetField" style="border-left: 5px solid #198754 !important;">
                                <h5 class="fw-bold text-success mb-3"><i class="fas fa-camera me-2"></i>Target AR</h5>
                                <div class="mb-3">
                                    <label class="form-label">Gambar Target (foto/poster yang akan dipindai kamera)</label>
                                    @if($mission->target_image_url)
                                        <div class="d-flex align-items-center gap-3 mb-2">
                                            <img src="{{ $mission->target_image_url }}" alt="target" style="height:90px;border-radius:8px;border:1px solid #dee2e6">
                                            <div class="form-check"><input class="form-check-input" type="checkbox" name="remove_target_image" value="1" id="rmTarget"><label class="form-check-label small" for="rmTarget">Hapus gambar ini</label></div>
                                        </div>
                                    @endif
                                    <input type="file" name="target_image" accept="image/jpeg,image/png" class="form-control border rounded">
                                    <div class="form-text text-muted">JPG/PNG, maks 5 MB. Gunakan gambar yang detail dan kontras (bukan gambar polos). Gambar ini dicetak lalu ditempel di lokasi.</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Lebar cetak gambar (meter)</label>
                                        <input type="number" step="0.01" min="0.05" max="10" name="target_width" value="{{ old('target_width', $mission->target_width ?? '0.5') }}" class="form-control border rounded" placeholder="0.5">
                                        <div class="form-text text-muted">Ukur lebar gambar setelah dicetak. Contoh: A4 mendatar = 0.30.</div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Nama target bawaan aplikasi <small class="text-muted">(opsional)</small></label>
                                        <input type="text" name="target_image_name" id="targetInput" value="{{ old('target_image_name', $mission->target_image_name) }}" class="form-control border rounded" placeholder="Contoh: Gedung1">
                                        <div class="form-text text-muted">Isi hanya jika memakai target yang sudah tertanam di aplikasi (Gedung1–Gedung4). Kosongkan jika meng-upload gambar target.</div>
                                    </div>
                                </div>
                                <div class="mb-1">
                                    <label class="form-label">Gambar Sampul <small class="text-muted">(opsional, ditampilkan sebagai petunjuk di aplikasi)</small></label>
                                    @if($mission->cover_image_path)
                                        <div class="d-flex align-items-center gap-3 mb-2">
                                            <img src="{{ asset($mission->cover_image_path) }}" alt="sampul" style="height:90px;border-radius:8px;border:1px solid #dee2e6">
                                            <div class="form-check"><input class="form-check-input" type="checkbox" name="remove_cover_image" value="1" id="rmCover"><label class="form-check-label small" for="rmCover">Hapus gambar ini</label></div>
                                        </div>
                                    @endif
                                    <input type="file" name="cover_image" accept="image/jpeg,image/png" class="form-control border rounded">
                                    <div class="form-text text-muted">Jika kosong, aplikasi memakai gambar target sebagai sampul.</div>
                                </div>
                            </div>

                            {{-- Quiz Builder (Toggle Visibility) --}}
                            <div class="mb-4 p-4 border rounded bg-white shadow-sm" id="quizField" style="display: none; border-left: 5px solid #0d6efd !important;">
                                <h5 class="fw-bold text-primary mb-3"><i class="fas fa-pencil-ruler me-2"></i>Builder Kuis</h5>
                                <textarea name="quiz_data" id="quiz_data_input" style="display:none;">{{ old('quiz_data', is_array($mission->quiz_data) ? json_encode($mission->quiz_data) : $mission->quiz_data) }}</textarea>
                                <div class="mb-3">
                                    <label class="form-label">Pertanyaan Kuis</label>
                                    <input type="text" id="visual_question" class="form-control" oninput="updateQuizJson()">
                                </div>
                                <label class="form-label">Opsi Jawaban</label>
                                <div id="answers_container"></div>
                                <button type="button" class="btn btn-sm btn-outline-primary mt-2" onclick="addOption()"><i class="fas fa-plus me-1"></i> Tambah Opsi</button>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Deskripsi Misi</label>
                                <textarea class="form-control border rounded" style="height:120px" name="description">{{ old('description', $mission->description) }}</textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Poin Hadiah <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-star text-warning"></i></span>
                                        <input type="number" name="points_reward" value="{{ old('points_reward', $mission->points_reward) }}" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Hadiah Lencana</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-medal text-info"></i></span>
                                        <select name="badge_reward_id" class="form-select">
                                            <option value="">-- Tidak Ada --</option>
                                            @foreach ($badges as $badge)
                                                <option value="{{ $badge->id }}" {{ (old('badge_reward_id', $mission->badge_reward_id) == $badge->id) ? 'selected' : '' }}>{{ $badge->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.missions.index') }}" class="btn btn-light px-4">Batal</a>
                                <button type="submit" class="btn btn-primary px-4 shadow-sm">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            toggleFields();
            loadExistingQuizData();
        });

        function toggleFields() {
            var type = document.getElementById("typeSelect").value;
            var targetField = document.getElementById("targetField");
            var targetInput = document.getElementById("targetInput");
            var quizField = document.getElementById("quizField");
            var visualQuestion = document.getElementById("visual_question");

            if (type === "quiz") {
                quizField.style.display = "block";
                visualQuestion.setAttribute('required', 'required');

                targetField.style.display = "none";
                targetInput.removeAttribute('required');
            } else {
                quizField.style.display = "none";
                visualQuestion.removeAttribute('required');

                targetField.style.display = "block";
                // target boleh upload gambar ATAU nama target bawaan (dicek di server)
            }
        }

        // --- Logic JSON Parser & Builder (Copy dari response sebelumnya) ---
        function loadExistingQuizData() {
            const rawData = document.getElementById('quiz_data_input').value;
            if (!rawData || rawData === "null") {
                addOptionHTML('', 0, true); addOptionHTML('', 1, false); return;
            }
            try {
                let data = (typeof rawData === 'string') ? JSON.parse(rawData) : rawData;
                document.getElementById('visual_question').value = data.question || '';
                const container = document.getElementById('answers_container');
                container.innerHTML = '';
                const opts = data.answers || data.options;
                if (opts && Array.isArray(opts)) {
                    opts.forEach((ans, index) => {
                        const isCorrect = (index === parseInt(data.correct_index));
                        addOptionHTML(ans, index, isCorrect);
                    });
                }
            } catch (e) {
                console.error("Error parsing", e);
                addOptionHTML('', 0, true); addOptionHTML('', 1, false);
            }
        }

        function addOptionHTML(text, index, isChecked) {
            const container = document.getElementById('answers_container');
            const div = document.createElement('div');
            div.className = 'input-group mb-2';
            div.innerHTML = `
                <div class="input-group-text bg-light">
                    <input class="form-check-input mt-0" type="radio" name="correct_answer_radio" value="${index}" onchange="updateQuizJson()" ${isChecked ? 'checked' : ''}>
                </div>
                <input type="text" class="form-control answer-option" value="${text}" placeholder="Jawaban..." oninput="updateQuizJson()">
                <button class="btn btn-outline-danger" type="button" onclick="removeOption(this)"><i class="fas fa-trash"></i></button>
            `;
            container.appendChild(div);
        }

        function addOption() {
            const container = document.getElementById('answers_container');
            const index = container.children.length;
            addOptionHTML('', index, false);
            updateQuizJson();
        }

        function removeOption(button) {
            const container = document.getElementById('answers_container');
            if(container.children.length <= 2) { alert("Minimal 2 opsi!"); return; }
            button.parentElement.remove();
            const radios = document.querySelectorAll('input[name="correct_answer_radio"]');
            radios.forEach((radio, idx) => { radio.value = idx; });
            updateQuizJson();
        }

        function updateQuizJson() {
            const question = document.getElementById('visual_question').value;
            const answerInputs = document.querySelectorAll('.answer-option');
            const correctRadio = document.querySelector('input[name="correct_answer_radio"]:checked');
            let answers = [];
            answerInputs.forEach(input => answers.push(input.value));
            let correctIndex = correctRadio ? parseInt(correctRadio.value) : 0;
            const quizObj = { question: question, answers: answers, correct_index: correctIndex };
            document.getElementById('quiz_data_input').value = JSON.stringify(quizObj);
        }
    </script>
</body>
</html>
