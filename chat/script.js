document.addEventListener("DOMContentLoaded", () => {
    const messagesDiv = document.getElementById("messages");
    const messageInput = document.getElementById("messageInput");
    const sendButton = document.getElementById("sendButton");

    // Simulate user roles (student, advisor)
    const currentUserRole = "student"; // Change this to "advisor" for the advisor

    // Simulate logged-in user ID
    const currentUserId = 1; // Replace with actual user ID

    // Simulate chat data
    const conversations = [
        { id: 1, role: "student", userId: 1, advisorId: 2 },
        // Add more conversations...
    ];

    // Load conversation list in the sidebar
    conversations.forEach(conversation => {
        // Add conversation to the sidebar
    });

    // Load chat history for the selected conversation
    function loadChatHistory(conversationId) {
        messagesDiv.innerHTML = ""; // Clear previous messages
        const conversation = conversations.find(conv => conv.id === conversationId);

        // Simulate loading chat history from the server
        const chatHistory = [
            { senderId: conversation.advisorId, message: "Hello, how can I help you?" },
            // Add more messages...
        ];

        chatHistory.forEach(message => {
            // Display messages in the chat area
        });
    }

    // Send message when the send button is clicked
    sendButton.addEventListener("click", () => {
        const message = messageInput.value.trim();
        if (message !== "") {
            // Simulate sending message to the server
            // Remember to replace this with actual AJAX call
            const response = { status: "success" };
            
            if (response.status === "success") {
                // Add the sent message to the chat area
                messageInput.value = "";
            } else {
                // Handle error
            }
        }
    });

    // Simulate real-time incoming messages (polling or websockets)
    setInterval(() => {
        // Simulate receiving new messages from the server
        // Remember to replace this with actual AJAX call
        const newMessages = [
            { senderId: 2, message: "How can I assist you?" },
            // Add more messages...
        ];

        newMessages.forEach(message => {
            // Display incoming messages in the chat area
        });
    }, 2000); // Poll every 2 seconds
});
