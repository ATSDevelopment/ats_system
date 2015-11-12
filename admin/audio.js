var audio_array = ['audio1', 'audio2'];
var current = 0;

function play_audio(){
	audio_player = document.getElementById("audio_player");
	audio_player.src=audio_array[current];
	audio_player.play();

	current++;
}