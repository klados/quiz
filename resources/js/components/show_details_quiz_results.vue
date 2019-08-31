
<template>
	<div class='row'>
		<table class="table table-striped">
			<thead>
				<tr>      
					<th scope="col">Quiz Name</th>
					<th scope="col">Score</th>
					<th scope="col">User Email</th>
					<th scope="col">Date</th>
					<th scope="col">Action</th>
				</tr>
			</thead>
			<tbody>
			<tr v-for="row in results">
				<td>{{row.quizName}}</td>
				<td>{{row.score}}</td>
				<td>{{row.user_email}}</td>
				<td>{{row.created_at}}</td>
				<td<button v-on:click='loadContent( row.id)'  type="button" class="btn btn-primary" data-toggle="modal" data-target="#infoModal">Show More</button></td>
			</tr>
			</tbody>
		</table>


		<div class="modal" id="infoModal">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
					<h4 class="modal-title">Quiz</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
					<ul class="list-group mb-2" v-for='row in ans'>
						<li class="list-group-item active">Question: {{row.question}}</li>

						<span v-if='row.correct_answer != ""'>
						<li  class="list-group-item">Correct answer: {{row.correct_answer}}</li>
						<li class="list-group-item">Your answer: {{row.answer}}</li>
						</span>
						<span v-else>
						<li class="list-group-item">
							<editor :initial-value="row.answer" api-key="rqb4z2v1v0xfnw6jwbtzqnrl5h0a60suba45n5ke7y7ibpgg" :init="{plugins: 'code', menubar: false}"></editor>
						</li>
						</span>

					</ul>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>

	</div>
</template>

<script>
import Editor from '@tinymce/tinymce-vue';
export default{
	props:[
		'answers',
		'results'
	],
	data(){
		return{
			ans:[],
		}
	},
	components: {
  	'editor': Editor // <- Important part
  },
	methods:{
		loadContent: function(id){
			this.ans = this.answers.filter(d => d.res_id === id);
			// console.log('this is ', ans)
		},

	},
}
</script>
