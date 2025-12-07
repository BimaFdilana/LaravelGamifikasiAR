<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Misi Baru</title>
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
                        <h3 class="fw-bold text-dark mb-1">Tambah Misi Baru</h3>
                    </div>
                    <a href="{{ route('admin.missions.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 mb-4">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="card p-4">
                    <div class="card-body">
                        <form action="{{ route('admin.missions.store') }}" method="POST">
                            @csrf

                            {{-- Judul & Tipe --}}
                            <div class="row">
                                <div class="col-md-8 mb-4">
                                    <label class="form-label">Judul Misi <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-heading"></i></span>
                                        <input type="text" name="title" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-4">
                                    <label class="form-label">Tipe Misi <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-tags"></i></span>
                                        <select name="type" id="typeSelect" class="form-select" required onchange="toggleFields()">
                                            <option value="book">Book (AR)</option>
                                            <option value="building">Building (AR)</option>
                                            <option value="quiz">Quiz (UI)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            {{-- Target Vuforia (AKAN DISEMBUNYIKAN JIKA QUIZ) --}}
                            <div class="mb-4" id="targetField">
                                <label class="form-label">Nama Target Vuforia <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-cube"></i></span>
                                    <input type="text" name="target_image_name" id="targetInput" class="form-control" placeholder="Sesuai Database Vuforia Unity">
                                </div>
                                <div class="form-text text-muted">Wajib diisi untuk tipe AR (Book/Building).</div>
                            </div>

                            {{-- QUIZ BUILDER SECTION --}}
                            <div class="mb-4 p-4 border rounded bg-white shadow-sm" id="quizField" style="display: none; border-left: 5px solid #0d6efd !important;">
                                <h5 class="fw-bold text-primary mb-3"><i class="fas fa-pencil-ruler me-2"></i>Builder Kuis</h5>
                                <textarea name="quiz_data" id="quiz_data_input" style="display:none;"></textarea>
                                <div class="mb-3">
                                    <label class="form-label">Pertanyaan Kuis</label>
                                    <input type="text" id="visual_question" class="form-control" oninput="updateQuizJson()">
                                </div>
                                <label class="form-label">Opsi Jawaban <small class="text-muted">(Pilih jawaban benar)</small></label>
                                <div id="answers_container">
                                    {{-- Default option A --}}
                                    <div class="input-group mb-2">
                                        <div class="input-group-text bg-light">
                                            <input class="form-check-input mt-0" type="radio" name="correct_answer_radio" value="0" onchange="updateQuizJson()" checked>
                                        </div>
                                        <input type="text" class="form-control answer-option" placeholder="Jawaban A" oninput="updateQuizJson()">
                                        <button class="btn btn-outline-danger" type="button" onclick="removeOption(this)"><i class="fas fa-trash"></i></button>
                                    </div>
                                    {{-- Default option B --}}
                                    <div class="input-group mb-2">
                                        <div class="input-group-text bg-light">
                                            <input class="form-check-input mt-0" type="radio" name="correct_answer_radio" value="1" onchange="updateQuizJson()">
                                        </div>
                                        <input type="text" class="form-control answer-option" placeholder="Jawaban B" oninput="updateQuizJson()">
                                        <button class="btn btn-outline-danger" type="button" onclick="removeOption(this)"><i class="fas fa-trash"></i></button>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-primary mt-2" onclick="addOption()"><i class="fas fa-plus me-1"></i> Tambah Opsi</button>
                            </div>

                            {{-- Deskripsi & Reward (Sama seperti sebelumnya) --}}
                            <div class="mb-4">
                                <label class="form-label">Deskripsi Misi</label>
                                <textarea class="form-control border rounded" style="height:100px" name="description"></textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Poin Hadiah <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-star text-warning"></i></span>
                                        <input type="number" name="points_reward" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Hadiah Lencana</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-medal text-info"></i></span>
                                        <select name="badge_reward_id" class="form-select">
                                            <option value="">-- Tidak Ada --</option>
                                            @foreach ($badges as $badge) <option value="{{ $badge->id }}">{{ $badge->name }}</option> @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.missions.index') }}" class="btn btn-light px-4">Batal</a>
                                <button type="submit" class="btn btn-primary px-4 shadow-sm">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // LOGIC TOGGLE UTAMA
        function toggleFields() {
            var type = document.getElementById("typeSelect").value;

            var targetField = document.getElementById("targetField");
            var targetInput = document.getElementById("targetInput");

            var quizField = document.getElementById("quizField");
            var visualQuestion = document.getElementById("visual_question");

            if (type === "quiz") {
                // Mode Quiz: Tampilkan Quiz Builder, Sembunyikan Target
                quizField.style.display = "block";
                visualQuestion.setAttribute('required', 'required');

                targetField.style.display = "none";
                targetInput.removeAttribute('required'); // Agar form bisa disubmit tanpa target
                targetInput.value = ""; // Kosongkan nilai target jika ada
            } else {
                // Mode AR: Tampilkan Target, Sembunyikan Quiz
                quizField.style.display = "none";
                visualQuestion.removeAttribute('required');
                document.getElementById('quiz_data_input').value = "";

                targetField.style.display = "block";
                targetInput.setAttribute('required', 'required'); // Wajib isi target
            }
        }

        // --- Logic Quiz Builder (Sama seperti sebelumnya) ---
        function addOption() {
            const container = document.getElementById('answers_container');
            const index = container.children.length;
            const div = document.createElement('div');
            div.className = 'input-group mb-2';
            div.innerHTML = `
                <div class="input-group-text bg-light">
                    <input class="form-check-input mt-0" type="radio" name="correct_answer_radio" value="${index}" onchange="updateQuizJson()">
                </div>
                <input type="text" class="form-control answer-option" placeholder="Jawaban Opsi..." oninput="updateQuizJson()">
                <button class="btn btn-outline-danger" type="button" onclick="removeOption(this)"><i class="fas fa-trash"></i></button>
            `;
            container.appendChild(div);
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

        // Jalankan saat load
        document.addEventListener("DOMContentLoaded", function() { toggleFields(); });
    </script>
</body>
</html>
