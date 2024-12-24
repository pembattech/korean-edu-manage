<x-app-layout>
    {{-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}

    <div>

        <form method="POST" action="{{ route('exam_question.store') }}" enctype="multipart/form-data" id= "questionForm"
            class="px-4 mx-auto max-w-2xl" novalidate>

            <h1 class="mb-4 text-2xl font-extrabold leading-none tracking-tight md:text-3xl lg:text-4xl text-gray-600">
                Add Question</h1>

            @csrf
            <div class="grid gap-4 sm:grid-cols-[1fr_1fr] sm:gap-6">

                <div class="mb-2">
                    <label class="block mb-2 text-base font-medium text-gray-900" for="set_number">Set
                        Number:</label>
                    <input type="number"
                        class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg shadow-sm border-2 border-transparent text-gray-900 text-sm rounded-lg focus:border-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        id="set_number" name="set_number" required>

                    <span class="text-red-500 font-medium text-base hidden" id="set_number_error">Set number is
                        required</span>
                </div>

                <div class="mb-2">
                    <label class="block mb-2 text-base font-medium text-gray-900" for="question_number">Question
                        Number:</label>
                    <input type="number"
                        class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg shadow-sm border-2 border-transparent text-gray-900 text-sm rounded-lg focus:border-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        id="question_number" name="question_number" required>

                    <span class="text-red-500 font-medium text-base hidden" id="question_number_error">Question
                        number
                        is
                        required</span>

                    <span class="text-red-500 font-medium text-base hidden" id="question_number_l40_error">Only up
                        to 40 is allowed.</span>

                    <span id="qn_error-message" class="text-red-500 font-medium text-base"></span>

                </div>

            </div>

            <div class="mb-2">
                <label class="block mb-2 text-base font-medium text-gray-900" for="question">Question:</label>
                <input type="text"
                    class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg shadow-sm border-2 border-transparent text-gray-900 text-sm rounded-lg focus:border-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    id="question" name="heading" required>

                <span class="text-red-500 font-medium text-base hidden" id="question_error">Question is
                    required</span>
            </div>

            <div class="mb-2">
                <label class="block mb-2 text-base font-medium text-gray-900" for="question_type">Question
                    Description Type:</label>
                <select
                    class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg shadow-sm border-2 border-transparent text-gray-900 text-sm rounded-lg focus:border-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    id="question_type" name="question_type" onchange="handleQuestionTypeChange()">

                    <option class="bg-blue-300" value="">Select Question Type</option>
                    <option class="bg-blue-300" value="text">Text</option>
                    <option class="bg-blue-300" value="image">Image</option>
                    <option class="bg-blue-300" value="audio">Audio</option>
                </select>

                <span class="text-red-500 font-medium text-base hidden" id="question_type_error">Question type is
                    required</span>
            </div>

            <div class="mb-2" id="question_description_container">
                <label class="block mb-2 text-base font-medium text-gray-900" for="question_description">Question
                    Description:</label>
                <textarea
                    class="question_description bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg shadow-sm border-2 border-transparent text-gray-900 text-sm rounded-lg focus:border-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    id="question_description" name="question_description"></textarea>
                <img id="question_image_preview" class="mt-2 hidden" style="max-width: 100%; height: auto;" />

                <audio id="question_audio_preview" class="mt-2 hidden" controls></audio>


                <p id="question_description_error" class="text-red-500 font-medium text-base hidden">Question
                    description is
                    required.</p>

                <p id="question_description_image_error" class="text-red-500 font-medium text-base hidden">Please
                    upload an image.</p>

                <p id="question_description_audio_error" class="text-red-500 font-medium text-base hidden">Please
                    upload an audio.</p>
            </div>

            <div class="mb-2">
                <label class="block mb-2 text-base font-medium text-gray-900" for="answer_type">Answer Type:</label>
                <select
                    class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg shadow-sm border-2 border-transparent text-gray-900 text-sm rounded-lg focus:border-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    id="answer_type" name="answer_type" onchange="handleAnswerTypeChange()">
                    <option class="bg-blue-300" value="">Select Answer Type</option>
                    <option class="bg-blue-300" value="text">Text</option>
                    <option class="bg-blue-300" value="image">Image</option>
                    <option class="bg-blue-300" value="audio">Audio</option>
                </select>

                <p id="answer_type_error" class="text-red-500 font-medium text-base hidden">Answer type is required.
                </p>
            </div>

            <div class="grid gap-4 sm:grid-cols-[1fr_1fr] sm:gap-4" id="answer_options_container">
                <div class="mb-2">
                    <label class="block mb-2 text-base font-medium text-gray-900" for="option_1">Option 1:</label>
                    <input type="text"
                        class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg shadow-sm border-2 border-transparent text-gray-900 text-sm rounded-lg focus:border-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        id="option_1" name="option_1">
                    <img id="option_1_preview" class="mt-2 hidden" style="max-width: 100%; height: auto;" />

                    <audio id="option_1_audio_preview" class="hidden" controls></audio>

                    <p id="option_1_error" class="text-red-500 font-medium text-base hidden">Option 1 is required.
                    </p>

                    <p id="option_1_image_error" class="text-red-500 font-medium text-base hidden">Please upload
                        an
                        image.</p>

                    <p id="option_1_audio_error" class="text-red-500 font-medium text-base hidden">Please upload
                        an
                        audio.</p>

                </div>

                <div class="mb-2">
                    <label class="block mb-2 text-base font-medium text-gray-900" for="option_2">Option 2:</label>
                    <input type="text"
                        class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg shadow-sm border-2 border-transparent text-gray-900 text-sm rounded-lg focus:border-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        id="option_2" name="option_2">
                    <img id="option_2_preview" class="mt-2 hidden" style="max-width: 100%; height: auto;" />

                    <audio id="option_2_audio_preview" class="hidden" controls></audio>

                    <p id="option_2_error" class="text-red-500 font-medium text-base hidden">Option 2 is required.
                    </p>

                    <p id="option_2_image_error" class="text-red-500 font-medium text-base hidden">Please upload
                        an image.</p>

                    <p id="option_2_audio_error" class="text-red-500 font-medium text-base hidden">Please upload
                        an audio.</p>

                </div>

                <div class="mb-2">
                    <label class="block mb-2 text-base font-medium text-gray-900" for="option_3">Option 3:</label>
                    <input type="text"
                        class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg shadow-sm border-2 border-transparent text-gray-900 text-sm rounded-lg focus:border-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        id="option_3" name="option_3">
                    <img id="option_3_preview" class="mt-2 hidden" style="max-width: 100%; height: auto;" />

                    <audio id="option_3_audio_preview" class="hidden" controls></audio>

                    <p id="option_3_error" class="text-red-500 font-medium text-base hidden">Option 3 is required.
                    </p>

                    <p id="option_3_image_error" class="text-red-500 font-medium text-base hidden">Please upload
                        an image.</p>

                    <p id="option_3_audio_error" class="text-red-500 font-medium text-base hidden">Please upload
                        an audio.</p>

                </div>

                <div class="mb-2">
                    <label class="block mb-2 text-base font-medium text-gray-900" for="option_4">Option 4:</label>
                    <input type="text"
                        class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg shadow-sm border-2 border-transparent text-gray-900 text-sm rounded-lg focus:border-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        id="option_4" name="option_4">
                    <img id="option_4_preview" class="mt-2 hidden" style="max-width: 100%; height: auto;" />

                    <audio id="option_4_audio_preview" class="hidden" controls></audio>

                    <p id="option_4_error" class="text-red-500 font-medium text-base hidden">Option 4 is required.
                    </p>

                    <p id="option_4_image_error" class="text-red-500 font-medium text-base hidden">Please upload
                        an image.</p>

                    <p id="option_4_audio_error" class="text-red-500 font-medium text-base hidden">Please upload
                        an audio.</p>

                </div>
            </div>

            <div class="mb-2">
                <label class="block mb-2 text-base font-medium text-gray-900" for="correct_answer">Correct
                    Answer:</label>
                <select
                    class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg shadow-sm border-2 border-transparent text-gray-900 text-sm rounded-lg focus:border-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    id="correct_answer" name="correct_answer">
                    <option class="bg-blue-300" value="">Select Correct Option</option>
                    <option class="bg-blue-300" value="option_1">Option 1</option>
                    <option class="bg-blue-300" value="option_2">Option 2</option>
                    <option class="bg-blue-300" value="option_3">Option 3</option>
                    <option class="bg-blue-300" value="option_4">Option 4</option>
                </select>
                <p id="correct_answer_error" class="text-red-500 font-medium text-base hidden">Correct answer is
                    required.
                </p>
            </div>

            <button type="submit" id="submit-button"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-base px-4 py-2 w-full mb-4">Submit</button>

            <button type="reset"
                class="w-full bg-gray-800 border border-transparent font-medium rounded-lg text-base px-4 py-2 mb-4 text-white tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Cancel</button>
        </form>

        <!-- Popup HTML -->
        <div id="popup"
            class="fixed z-50 inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center hidden">
            <div class="bg-white p-4 rounded-lg shadow-lg">
                <h2 class="text-lg font-semibold mb-2">Success!</h2>
                <p>Your question has been added successfully.</p>
                <div class="mt-4">
                    <button id="addAnotherQuestion"
                        class="text-white bg-blue-500 hover:bg-blue-600 focus:outline-none font-medium rounded-lg text-sm px-4 py-2 mr-2">Add
                        Another Question</button>
                    <button id="closePopup"
                        class="text-white bg-red-500 hover:bg-red-600 focus:outline-none font-medium rounded-lg text-sm px-4 py-2">Close</button>
                </div>
            </div>
        </div>

    </div>


    <script>
        function handleQuestionTypeChange() {
            const questionType = document.getElementById('question_type').value;
            const questionDescriptionContainer = document.getElementById('question_description_container');
            const questionImagePreview = document.getElementById('question_image_preview');
            console.log(questionImagePreview);
            const questionAudioPreview = document.getElementById('question_audio_preview');

            // Check if the current element is a file input, textarea, or audio element
            const currentElement = document.getElementById('question_description_image') ||
                document.getElementById('question_description_audio') ||
                document.getElementById('question_description');

            if (questionType === 'image') {
                // Create a new file input for the image
                const fileInput = document.createElement('input');
                fileInput.type = 'file';
                fileInput.name = 'question_description_image';
                fileInput.id = 'question_description_image';
                fileInput.className = currentElement.className; // Reuse the class name
                fileInput.accept = 'image/*'; // Accept only image files
                fileInput.onchange = function() {
                    previewImage(fileInput, questionImagePreview);
                };

                currentElement.replaceWith(fileInput);
                questionImagePreview.classList.remove('hidden');
                questionAudioPreview.classList.add('hidden');
            } else if (questionType === 'audio') {
                // Create a new file input for the audio
                const fileInput = document.createElement('input');
                fileInput.type = 'file';
                fileInput.name = 'question_description_audio';
                fileInput.id = 'question_description_audio';
                fileInput.className = currentElement.className; // Reuse the class name
                fileInput.accept = 'audio/*'; // Accept only audio files
                fileInput.onchange = function() {
                    previewAudio(fileInput, questionAudioPreview);
                };

                currentElement.replaceWith(fileInput);
                questionImagePreview.classList.add('hidden');
                questionAudioPreview.classList.remove('hidden');
            } else {
                // Create a new textarea for the text
                const textarea = document.createElement('textarea');
                textarea.name = 'question_description';
                textarea.id = 'question_description';
                textarea.className = currentElement.className; // Reuse the class name

                currentElement.replaceWith(textarea);
                questionImagePreview.classList.add('hidden');
                questionAudioPreview.classList.add('hidden');
            }
        }

        function handleAnswerTypeChange() {
            const answerType = document.getElementById('answer_type').value;

            for (let i = 1; i <= 4; i++) {
                // Get the current element (either the text input, image input, or audio input)
                const currentElement = document.getElementById('option_' + i + '_image') ||
                    document.getElementById('option_' + i + '_audio') ||
                    document.getElementById('option_' + i);
                const optionPreview = document.getElementById('option_' + i + '_preview');
                const optionAudioPreview = document.getElementById('option_' + i + '_audio_preview');

                if (currentElement) {
                    if (answerType == 'image') {
                        // Create a new file input for the image
                        const fileInput = document.createElement('input');
                        fileInput.type = 'file';
                        fileInput.name = 'option_' + i + '_image';
                        fileInput.id = 'option_' + i + '_image';
                        fileInput.className = currentElement.className;
                        fileInput.accept = 'image/*'; // Accept only image files
                        fileInput.onchange = function() {
                            previewImage(fileInput, optionPreview);
                        };

                        currentElement.replaceWith(fileInput);
                        optionPreview.classList.remove('hidden');
                        optionAudioPreview.classList.add('hidden');
                    } else if (answerType == 'audio') {
                        // Create a new file input for the audio
                        const fileInput = document.createElement('input');
                        fileInput.type = 'file';
                        fileInput.name = 'option_' + i + '_audio';
                        fileInput.id = 'option_' + i + '_audio';
                        fileInput.className = currentElement.className;
                        fileInput.accept = 'audio/*'; // Accept only audio files
                        fileInput.onchange = function() {
                            previewAudio(fileInput, optionAudioPreview); // You need to implement this function
                        };

                        currentElement.replaceWith(fileInput);
                        optionPreview.classList.add('hidden');
                        optionAudioPreview.classList.remove('hidden');


                    } else {
                        // Create a new text input for the text
                        const textInput = document.createElement('input');
                        textInput.type = 'text';
                        textInput.name = 'option_' + i;
                        textInput.id = 'option_' + i;
                        textInput.className = currentElement.className;

                        currentElement.replaceWith(textInput);
                        optionPreview.classList.add('hidden');
                        optionAudioPreview.classList.add('hidden');
                    }
                }
            }
        }

        function previewImage(input, previewElement) {
            const file = input.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                previewElement.src = e.target.result;
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        }

        // Function to preview the selected audio
        function previewAudio(fileInput, previewElement) {
            const file = fileInput.files[0];
            const reader = new FileReader();
            reader.onload = function(e) {
                previewElement.src = e.target.result;
                previewElement.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    </script>

    <script>
        $(document).ready(function() {

            function checkQuestionNumber(inputElement) {
                let questionNumber = $('#question_number').val(); // Use the correct input
                let setNumber = $('#set_number').val();

                if (questionNumber && setNumber) {

                    $.ajax({
                        url: '{{ route('checkQuestionNumber') }}',
                        method: 'get',
                        data: {
                            question_number: questionNumber,
                            set_number: setNumber,
                        },
                        success: function(response) {
                            console.log(response)
                            if (response.exists) {
                                $('#qn_error-message').text(
                                    'Question number exists for this set.');

                                $('#submit-button').prop('disabled', true).addClass(
                                    'bg-gray-900 cursor-not-allowed');
                            } else {
                                $('#qn_error-message').text('');
                                $('#submit-button').prop('disabled', false).removeClass(
                                    'bg-gray-900 cursor-not-allowed');
                            }
                        },
                        error: function() {
                            $('#qn_error-message').text(
                                'An error occurred while checking.');
                        }
                    });
                }
            }

            // Keyup event for set number
            $('#set_number').on('keyup', function() {
                console.log('f');
                checkQuestionNumber(this); // Pass the current element to the function
            });

            // Keyup event for question number
            $('#question_number').on('keyup', function() {
                console.log('f');
                checkQuestionNumber(this); // Pass the current element to the function
            });

            $('#resetButton').on('click', function() {
                $('#questionForm')[0].reset();
            });
        });
    </script>

</x-app-layout>
