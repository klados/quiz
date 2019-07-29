<template>
		<button class='btn btn-warning flex-item' v-on:click='redirect()'>Delete</button>
</template>

<script>
export default{
	props:[
	'quiz_id',
	],
	methods:{
		redirect: function(){
			if(confirm('Are you sure you want to delete this quiz?')){
				console.log('delete it')
				window.location.href = '/delete_quiz/'+this.quiz_id;
			}
		}
	}
}
</script>
