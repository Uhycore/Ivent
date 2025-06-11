<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>AI Customer Service</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="relative min-h-screen bg-gray-100">
    <!-- INDEX.PHP sebagai background transparan -->
    <iframe src="index.php" class="fixed top-0 left-0 w-full h-full z-10 bg-transparent" allowtransparency="true">
    </iframe>
    <!-- index.php sebagai background -->
    <iframe src="index.php" class="fixed top-0 left-0 w-full h-full z-0" frameborder="0"
        allowtransparency="true"></iframe>
    <!-- Live2D Widget -->
    <div id="live2d-widget" class="fixed right-0 bottom-0 w-80 h-96 z-40"></div>
    <!-- Chatbot Card Transparan -->
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="w-full max-w-xl h-[90vh] bg-white/60 backdrop-blur-md rounded-2xl shadow-xl flex flex-col overflow-hidden">
            <!-- Header -->
            <div class="relative">
                <div class="bg-[#d2dcff] text-gray-500 text-lg font-semibold p-4 text-center">
                    I-Bot
                </div>
                <button id="closeChat" onclick="window.location.href='index.php'" class="absolute top-2 right-2 text-gray-500 text-xl font-bold mt-3 mr-3">x</button>
            </div>

            <!-- Chat Area -->
            <div id="chatMessages" class="flex-1 p-4 overflow-y-auto space-y-4">
                <!-- Pesan Bot Awal -->
                <div class="flex items-start space-x-3">
                    <div class="w-10 h-10 rounded-full overflow-hidden">
                        <img src="{{ '../images/chatbot.avif' }}" alt="Bot" class="w-full h-full object-cover" />
                    </div>
                    <div class="bg-blue-100 text-blue-800 p-3 rounded-xl text-sm max-w-[75%]">
                        Halo! Saya asisten virtual Anda. <br>
                        Apakah ada yang bisa saya bantu seputar penggunaan website kami? 😊
                    </div>
                </div>
            </div>

            <!-- Input -->
            <div class="p-4 bg-white/80 border-t flex space-x-3">
                <input id="userInput" type="text" placeholder="Ketik pesan..." onkeypress="handleKeyPress(event)"
                    class="flex-1 px-4 py-2 border rounded-lg text-sm focus:outline-none focus:ring focus:border-blue-400" />
                <button onclick="sendMessage()"
                    class="bg-[#d2dcff] text-gray-800 px-4 py-2 rounded-lg text-sm hover:bg-[#c6d2ff] transition">
                    Kirim
                </button>
            </div>
        </div>
    </div>
    <script>
        // Inisialisasi Live2D Character
        window.addEventListener("load", function() {
            if (typeof L2Dwidget !== "undefined") {
                L2Dwidget.init({
                    model: {
                        jsonPath: "{{ asset('live2d/model/sagiri/model.json') }}",
                        scale: 0.5
                    },
                    display: {
                        position: "right",
                        width: 500,
                        height: 500,
                        hOffset: -50,
                        vOffset: -80
                    },
                    mobile: {
                        show: true
                    }
                });
            } else {
                console.warn("L2Dwidget script is not loaded.");
            }
        });
        async function sendMessage() {
            const input = document.getElementById('userInput');
            const userMessage = input.value.trim();
            const chatMessages = document.getElementById('chatMessages');

            if (!userMessage) return;

            // Add user message to chat
            const userDiv = document.createElement('div');
            userDiv.className = 'message user-message';
            userDiv.innerHTML = userMessage + '<div class="timestamp">' + getCurrentTime() + '</div>';
            chatMessages.appendChild(userDiv);

            // Clear input
            input.value = '';

            // Add typing indicator
            const typingDiv = document.createElement('div');
            typingDiv.className = 'message bot-message typing-indicator';
            typingDiv.innerHTML =
                '<div class="typing-dot"></div><div class="typing-dot"></div><div class="typing-dot"></div>';
            chatMessages.appendChild(typingDiv);

            // Scroll to bottom
            chatMessages.scrollTop = chatMessages.scrollHeight;

            try {
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                const response = await fetch('{{ route('chat') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        message: userMessage
                    }),
                });

                const data = await response.json();

                // Remove typing indicator
                chatMessages.removeChild(typingDiv);

                // Add bot response
                const botDiv = document.createElement('div');
                botDiv.className = 'message bot-message';
                botDiv.innerHTML = marked.parse(data.response) + '<div class="timestamp">' + getCurrentTime() +
                    '</div>';
                chatMessages.appendChild(botDiv);

                // Scroll to bottom
                chatMessages.scrollTop = chatMessages.scrollHeight;
            } catch (error) {
                // Remove typing indicator
                chatMessages.removeChild(typingDiv);

                // Add error message
                const errorDiv = document.createElement('div');
                errorDiv.className = 'message bot-message';
                errorDiv.textContent = 'Sorry, an error occurred. Please try again.';
                chatMessages.appendChild(errorDiv);

                // Scroll to bottom
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }
        }

        function handleKeyPress(event) {
            if (event.key === 'Enter') {
                sendMessage();
            }
        }

        function getCurrentTime() {
            const now = new Date();
            let hours = now.getHours();
            let minutes = now.getMinutes();
            const ampm = hours >= 12 ? 'PM' : 'AM';

            hours = hours % 12;
            hours = hours ? hours : 12; // the hour '0' should be '12'
            minutes = minutes < 10 ? '0' + minutes : minutes;

            return hours + ':' + minutes + ' ' + ampm;
        }
    </script>
</body>

</html>
