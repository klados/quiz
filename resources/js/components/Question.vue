<template>
	<div style='background-color:#dfe1e2!important' class='pt-2 pb-2 pl-2 pr-2 mb-5'>
	
		<div>
			<button v-on:click='delete_question' type='button' class='btn btn-warning float-right'>Delete</button>
		</div>

		<div class='form-group'>
			<label>Question {{question_id +1}}:</label>
			<input :name="'questions['+ question_id + `][question]`" type='text' class='form-control' required>
		</div>


		<div class='form-group'>
	 		<label :for="'sel'+ question_id">Select type of answer:</label>
		  	<select :name="'questions['+ question_id + `][type_of_question]`" v-model="select_type" class=form-control :id="'sel'+ question_id">
					<option disabled value="">Select one</option>
					<option>Text</option>
					<option>Single Line</option>
					<option>Radio buttons</option>
				</select>
 		</div> 

		
		<div v-if="select_type === 'Text'">
			<p>You have to verify the answer manualy</p>
		</div>

		<div v-else-if="select_type === 'Single Line'">
			<p>The user must type exactly the same words as your's answer</p>
		</div>
		<div v-else>
			<radio></radio>
		</div>

		<div class='form-group' v-if='select_type == "Single Line" || select_type == "Radio buttons"'>
			<label>Correct answer:</label>
			<input placeholder='And the answer is...' :name="'questions['+question_id +`][correct_answer]`" type='text' class='form-control' required>
		</div>

	</div>
</template>

<script>
import Radio from './Radio_button.vue';

export default{
	props:[
		'question_id',
	],
	data(){
		return{
			'select_type':'Text'
		}
	},
	methods:{
		delete_question: function(){
			this.$emit('content-block-remove');
		},
		selectTypeOfQuestion: function(event){
      console.log(event.target.value)
		}

	},
	updated(){
		console.log('child update')
	}
	// watch: {
	// 	question_id(){
	// 		console.log('wathch')
	// 	}
  //
	// }

}
</script>
