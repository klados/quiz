<template>
	<div>

		<div v-for="input in inputs" :key='input.id' class=input-group mb-12>
			<input type='text' :name="'questions['+ $parent.question_id+`][options][]`" class="form-control" placeholder="Possible Answer" required>
			<div class=input-group-append>
				<button class="btn btn-warning" type='button' v-on:click='delete_input(input.id)'>Delete</button>
			</div>
		</div>



		<div v-if="show_limit_msg">
			<div class='alert alert-warning'>You can not add more than 10 fields</div>
		</div>

		<div class='row justify-content-center mt-5'>
			<button type='button' class='btn btn-primary' v-on:click="addNew">Add Answer</button>
		</div>

	</div>
</template>


<script>

export default{
	props:[],
	data(){
		return{
			'inputs':[],
			'counter':0,
			'show_limit_msg': false
		}
	},
	methods:{
		addNew: function(){
			if(this.counter >= 10){
				this.show_limit_msg = true;
			}
			else{
				this.inputs.push({id:this.counter})
				this.counter++;
			}
		},
		delete_input: function(item){
			console.log('itme deleted', item)
			this.inputs.splice(item,1);
			for(let i=0;i<this.inputs.length;i++){
				this.inputs[i].id = i;
			}
			console.log('delete', this.inputs)
			this.counter--;
		},
		check_if_answer_exists: function(){

		}
	}
}
</script>
