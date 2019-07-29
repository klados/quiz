<template>
	<div>
		
		<div v-for="field in fields" :key="field.id">
			<question v-on:content-block-remove="delete_question(field.id)" v-bind:question_id="field.id"></question>
		</div>

		<div class='row justify-content-center mt-5'>
			<button type='button' class='btn btn-primary' v-on:click="add">Add Question</button>
		</div>

	</div>
</template>

<script>
 import Alert from './Question.vue';

export default{
	data(){
		return{
			fields: [],
			counter: 0
		}
	},
	methods: {
		add: function(){
			console.log('add new question!!', this.counter);
			this.fields.push({'id':this.counter}); //
			this.counter++;
		},

		delete_question: function(index){
			this.fields.splice(index,1);
			
			for(let i=0;i<this.fields.length;i++){
				console.log('i',this.fields[i].id, i)
				this.fields[i].id = i;
				// this.$set(this.someObject, 'b', i)
			}

			console.log('fields',this.fields)
			this.counter--;
		}
	},
	updated() {
		console.log('updated', this.fields)		
	}

}
</script>
