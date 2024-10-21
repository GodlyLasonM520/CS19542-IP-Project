const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
if (!SpeechRecognition) {
    alert("Speech Recognition is not supported in this browser.");
}

let currentLang = 'en-US';
let isRecording = false; 
const recognition = new SpeechRecognition();
recognition.continuous = true; 
recognition.interimResults = true;  
const blogContent = document.getElementById('content');  

function startRecording() {
    if (isRecording) return; 
    recognition.lang = currentLang;  
    recognition.start();
    isRecording = true; 
    console.log(`Voice recognition started in ${currentLang}.`);
}

function stopRecording() {
    if (!isRecording) return; 
    recognition.stop();
    console.log('Voice recognition stopping...'); 
}

recognition.onresult = (event) => {
    let transcript = '';
    for (let i = event.resultIndex; i < event.results.length; i++) {
      
        if (event.results[i].isFinal) {
            transcript += event.results[i][0].transcript;
        }
    }
    if (transcript) {
        blogContent.value += transcript;  
        console.log("Typed text: ", transcript);  
    }
};

recognition.onerror = (event) => {
    console.error('Speech recognition error:', event.error);
    alert('Error occurred in speech recognition: ' + event.error); 
};

recognition.onend = () => {
    console.log('Speech recognition ended.');
    isRecording = false; 
};

function toggleLanguage() {
    const languageLabel = document.getElementById('current-language');
    if (currentLang === 'en-US') {
        currentLang = 'ta-IN'; 
        languageLabel.textContent = 'Tamil';
        console.log('Switched to Tamil');
    } else {
        currentLang = 'en-US'; 
        languageLabel.textContent = 'English';
        console.log('Switched to English');
    }

    
}
