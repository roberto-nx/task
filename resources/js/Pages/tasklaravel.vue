<template>


<h5>
Essa ferramenta funciona armazenando suas tarefas no armazenamento local do seu navegador. caso queira salvalas para utilizar em outros locais crie uma conta
</h5>
<h3>Dicas:</h3>
<h1>
 
Lista de tarefas
</h1>
<ul>
<li v-for="(task, numbertask) in tasks" :key="numbertask"  :id="'a'+task['numbertask']" >
  {{ task["task"]}} prioridade:{{ task["priority"]}}
  <br>
  <button @click.prevent="edit(id='a'+task['numbertask'])" >Editar</button>
  <button @click.prevent="destroy(id=task['numbertask'])">Deletar</button>
 
</li>
</ul>
<h3 >Nova tarefa</h3>
<form>
<label from="newtask">Tarefa</label>
<input  v-model="newtask" name="newtask" type="text"/>
<label from="priority" type="nunber">Numero da tarefa</label>
<input v-model="newtask_priority"  name="priority"/>
<br>
<button @click="submit">Salvar</button>
</form>
<button @click="clear">Limpar Tudo</button>
<Teleport  v-if="teleport_id" :to="`#${teleport_id}`">
  <label from="newtask">Tarefa</label>
  <input v-model="edit_task" type="text" name="editar"/> 
  <label from="priority" type="nunber">Numero da tarefa</label>
  <input v-model="edit_priority" type="text" name="editar"/> 
  <button @click="save">Salvar</button>
</Teleport>




</template>
<style scoped>
</style>

<script >
import { h } from 'vue'
export default {
    data() {
    return {
      edit_task:'',
      edit_priority:'',
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
      save(){
       const taskObject = {
        task:this.edit_task,
        priority:this.edit_priority,
        numbertask:this.teleport_id.replace('a','')
      }
      console.log(this.teleport_id.replace('a',''))
       localStorage.setItem(this.teleport_id.replace('a',''), JSON.stringify(taskObject))
      },
      destroy(id){
        console.log(id)
     localStorage.removeItem(id);
     

    },
    submit() {
      const taskObject = {
        task: this.newtask,
        priority:this.newtask_priority,
        numbertask:this.numbertasktotal+1
      }
        localStorage.setItem('numbertasktotal', JSON.stringify(this.numbertasktotal+1 ));
        localStorage.setItem(this.numbertasktotal+1, JSON.stringify(taskObject))
    },
    clear(){
      localStorage.clear();
    }

  },
   mounted() {

    const numbertasktotal = parseInt(localStorage.getItem("numbertasktotal"));
    if(numbertasktotal>0){this.numbertasktotal=numbertasktotal}
    const tasks = {}
    for (var i= 1; i<=numbertasktotal; i++) {
      if(localStorage.getItem(i)!=null)
    tasks[i]=JSON.parse(localStorage.getItem(i))
    }
    this.tasks=tasks;
   
    },
}
</script>