var questions = [
    {
        prompt: "test question", // <= question inside quotes including the choices a, b, c, d, etc.
        answer: "a", // answer inside quotes. a, b, c, d, etc. notice how the comma is used to separate the objects.
    }, //repeat for the rest of the questions. make sure you put the questions within the array.
];

var aiResponse = ""
var score = 0

for(var i = 0; i < questions.length; i++) { //cycles through asking all the questions
    var response = window.prompt(questions[i].prompt)
    //var response = document.getElementsByName("response")

    if(response == questions[i].answer){ //checks for right answer
        score++
        alert("Correct!") //CORRECT ANSWER!
    }
    else {
        alert("WRONG!") //WRONG ANSWER!
    }

    while(response !== questions[i].answer) { // Primitive Artificial Inteligence™® powered by aiResponse™® for computer responses based on score :)
        if(score >= 8) {
            var aiResponse = "Good Job! You did very well in this trivia game. Go brag to your friends!"
            break
        }
        
        else if(score <= 7 && score > 5) {
            var aiResponse = "You did pretty good. You just need some minor touchups in studying to get a better score."
            break
        }

        else if(score <= 5 && score > 3) {
            var aiResponse = "You didn't do so good. I wouldn't suggest bragging to your friends."
            break
        }

        else if(score <= 3 && score > 1){
            var aiResponse = "You did REALLY bad. Like...BAD. Don't show your friends."
            break
        }

        else if(score <= 1) {
            var aiResponse = "Just stop. Ok? Get out. Have you been living under a rock? You shouldn't even be here right now. Definitely DON'T show your friends...unless it's too late."
            break
        }

        else {
            var aiResponse = ""
            break
        }
    }
}

alert("You got " + score +"/" + questions.length + " questions right. " + aiResponse)
