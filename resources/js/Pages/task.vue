
<template>


<h5>
Essa ferramenta funciona armazenando suas tarefas no armazenamento local do seu navegador. caso queira salvalas para utilizar em outros locais crie uma conta
</h5>
<h3>Dicas:</h3>
<h1>
 
Lista de tarefas
</h1>
<ul>
<li v-for="(task, numbertask) in tasks" :key="numbertask" :class="task['numbertask']" :id="'a'+task['numbertask']" >
  {{ task["task"]}} prioridade:{{ task["priority"]}}
  <br>
  <button @click.prevent="edit(id='a'+task['numbertask'])" >Editar</button>

  <button @click="delet">Deletar</button>
 
</li>
</ul>
<h3 >Nova tarefa</h3>
<form>
<label from="newtask">Tarefa</label>
<input  v-model="newtask" name="newtask" type="text"/>
<label from="priority" type="nunber">Numero da tarefa</label>
<input v-model="newtask_priority"  name="priority"/>
<br>
<button @click.prevent="submit">Salvar</button>
</form>

<Teleport  v-if="teleport_id" :to="`#${teleport_id}`">
  <input type="text" name="editar"/> 
</Teleport>




</template>
<style scoped>
</style>

<script >
import { h } from 'vue'
export default {
    data() {
    return {
      editar:'',
      teleport_id:"",
      tasks:{},
      newtask:"",
      newtask_priority:"",
      numbertasktotal:0
    };
    },
    methods: {
      edit(id){
      this.teleport_id=id;
    

      },
    submit() {
      
      const taskObject = {
        task: this.newtask,
        priority:this.newtask_priority,
        numbertask:this.numbertasktotal+1
      }
        localStorage.setItem('numbertasktotal', JSON.stringify(this.numbertasktotal+1 ));
        localStorage.setItem(this.numbertasktotal+1, JSON.stringify(taskObject))
    }
  },
   mounted() {

    const numbertasktotal = parseInt(localStorage.getItem("numbertasktotal"));
    if(numbertasktotal>0){this.numbertasktotal=numbertasktotal}
    const tasks = {}
    for (var i= 1; i<=numbertasktotal; i++) {
    tasks[i]=JSON.parse(localStorage.getItem(i))
    }
    this.tasks=tasks;
   
    },
}
</script>