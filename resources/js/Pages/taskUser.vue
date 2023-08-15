
<script setup>
defineProps({ tasks: Object })
import { useForm } from '@inertiajs/vue3'
import {ref,computed} from 'vue'
let teleport_id=ref("")

const edit= (id)=>{
  teleport_id.value=id,
  editform.numbertask=id.replace('a','')
  }
  const destroy= (id)=>{
    form.delete('/destroy/task/'+id)
  }
const form = useForm({
  newtask: "",
  newtask_priority: "",
  task_description:"não",
});

const editform = useForm({
  edit_task:"",
  edit_priority:'',
  numbertask:'',
  task_description:"não"
})

</script>
<template>
<h5>
 você esta logado alterações ficaram salvas em seu usuário
</h5>
<h3>Dicas:</h3>
<ul>
<li v-for="(task, id) in tasks" :key="id"  :id="'a'+task['id']" >
  {{ task["task"]}} prioridade:{{ task["priority"]}}
  <br>
  <button @click="edit(id='a'+task['id'])" >Editar</button>
  <button @click.prevent="destroy(id=task['id'])">Deletar</button>
</li>
</ul>

<h1>
 


Lista de tarefas
</h1>
<ul>

</ul>
<h3 >Nova tarefa</h3>
<form @submit.prevent="form.post('/create/task', {
  onSuccess: () => form.reset('newtask','newtask_priority'),
})">
<label from="newtask">Tarefa</label>
<input  v-model="form.newtask" name="newtask" type="text"/>
<label from="priority" type="nunber">Numero da tarefa</label>
<input v-model="form.newtask_priority"  name="priority"/>
<br>
<button @click="submit" type="submit" :disabled="form.processing">Salvar</button>
</form>
<button @click="clear">Limpar Tudo</button>
<Teleport  v-if="teleport_id" :to="`#${teleport_id}`">
  <form @submit.prevent="editform.post('/update/task', {
  onSuccess: () => form.reset('editar','priority'),
})">
  <label from="editar">Tarefa</label>
  <input v-model="editform.edit_task" type="text" name="editar"/> 
  <label from="priority" type="nunber">Numero da tarefa</label>
  <input v-model="editform.edit_priority" type="text" name="priority"/> 
   <input v-model="editform.numbertask" type="text" name="numbertask" hidden /> 

  <button @click="submit">Salvar</button>
  </form>
</Teleport>


</template>
