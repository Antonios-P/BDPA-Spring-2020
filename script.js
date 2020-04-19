var questions = [
    {
        prompt: "", // <= question inside quotes including the choices a, b, c, d, etc.
        answer: "", // answer inside quotes. a, b, c, d, etc. notice how the comma is used to separate the objects.
    }, //repeat for the rest of the questions. make sure you put the questions within the array.
];

var score = 0;

for(var i = 0; i < questions.length; i++) { //cycles through asking all the questions
    var response = window.prompt(questions[i].prompt);

    if(response == questions[i].answer){ //checks for right answer
        score++;
        alert("Correct!"); //correct answer!
    }
    else {
        alert("WRONG!") //WRONG ANSWER!
    }
}
alert("You got" + score +"/" + questions.length + " questions right.")