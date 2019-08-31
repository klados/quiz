<template>
	<div>

	<div class='row'>
		<input v-model='search' class="form-control mb-5 col-12 " type="text" placeholder="Search" aria-label="Search">
	</div>

		<div class='row'>
		<div class="col-lg-4 mb-3" v-for="quiz in filter_quiz">
				<div class='card'>
					<div class="card-body">
						<h5 class="card-title">{{ quiz.quizName }}</h5>
						<div class="card-text">
							<p>{{quiz.description }}</p>
							<ul class="list-group">
								<li class="list-group-item">
									Max duration of quiz:
									<strong v-if="quiz.quiz_duration">Unlimited time</strong>
										<strong v-else>{{ quiz.quiz_duration }} min</strong>
								</li>
								<li class="list-group-item">
									Access mode: {{quiz.access}}
								</li>
								<li class="list-group-item">
									Created on: {{quiz.created_at}}
								</li>
							</ul>
						</div>

						<div class="col flex text-center mt-4">
							<a :href="'solve_quiz/'+quiz.id" class='flex-item card-link mr-3'>Solve</a>
						</div>

					</div>
				</div>
		</div>
		</div>

	</div>
</template>

<script>

export default{
	props:[
		'quizzes'
	],
	data(){
		return{
			search:''
		}
	},
	methods:{

	},
	computed:{
		filter_quiz: function(){
			return this.quizzes.filter((quiz)=>{
				return quiz.quizName.match(this.search);
			});
		}
	}

}
</script>
