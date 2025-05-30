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
</head>
<body>
	
	<div id="live2d-widget" class="fixed right-0 bottom-0 w-80 h-96 z-50"></div>

	<div class="fixed top-4 left-4 z-40">
        <a href="../index.php" class="btn btn-secondary">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>
	
    <div class="chat-container">
        <div class="chat-header">
            <span>AI Customer Service</span>
        </div>
        <div class="chat-messages" id="chatMessages">
            <div class="message bot-message">
                Hello! I'm your AI assistant. How can I help you today?
                <div class="timestamp">Just now</div>
            </div>
        </div>
        <div class="chat-input">
            <input type="text" class="form-control" id="userInput" placeholder="Type your message..." onkeypress="handleKeyPress(event)" />
            <button id="sendButton" onclick="sendMessage()">Send</button>
        </div>
			<!-- Scripts -->
			<script src="{{ asset('live2d/script/L2Dwidget.min.js') }}"></script>
		
    </div>
	
</div>
		

    <script>
		// Inisialisasi Live2D Character
    window.addEventListener("load", function () {
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
            typingDiv.innerHTML = '<div class="typing-dot"></div><div class="typing-dot"></div><div class="typing-dot"></div>';
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
                    body: JSON.stringify({ message: userMessage }),
                });

                const data = await response.json();
                
                // Remove typing indicator
                chatMessages.removeChild(typingDiv);
                
                // Add bot response
                const botDiv = document.createElement('div');
                botDiv.className = 'message bot-message';
                botDiv.innerHTML = marked.parse(data.response) + '<div class="timestamp">' + getCurrentTime() + '</div>';
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