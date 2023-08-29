
<script setup>
defineProps({ tasks: Object })
import { useForm } from '@inertiajs/vue3'
import {ref,computed} from 'vue'
import { Link } from '@inertiajs/vue3'
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
  newtask_amount: "",
  task_description:"não",
});

const editform = useForm({
  edit_task:"",
  edit_amount:'',
  numbertask:'',
  task_description:"não"
})


</script>
<template>
<div class="container-a">
<div class="card">
<h5 class="instruction">
 Você esta logado alterações ficaram salvas em seu usuário
</h5>
<h1>
Lista 
</h1>
<ul>
<li v-for="(task, id) in tasks" :key="id"  :id="'a'+task['id']" class="border-a">
 <div class="flex-grow"> {{ task["task"]}} quantidade:{{ task["amount"]}}</div>
  
  <button class="edit" @click="edit(id='a'+task['id'])" >Editar</button>
  <button class="delete" @click.prevent="destroy(id=task['id'])">Deletar</button>
</li>
</ul>
<ul>
</ul>
<div>
<h3 class="newtask">Novo Elemento</h3>
<form class="newtask" @submit.prevent="form.post('/create/task', {
  onSuccess: () => form.reset('newtask','newtask_amount'),
})">
<label from="newtask">Elemento</label>
<input  v-model="form.newtask" name="newtask" type="text"/>
<label from="amount" type="nunber">Quantidade</label>
<input v-model="form.newtask_amount"  name="amount"/>
<br>
<button class="save" @click="submit" type="submit" :disabled="form.processing">Salvar</button>
<button class="delete" @click="clear">Limpar Tudo</button>
</form>
</div>
</div>
<Teleport  v-if="teleport_id" :to="`#${teleport_id}`">
  <div class="border-b">
  <form @submit.prevent="editform.post('/update/task', {
  onSuccess: () => form.reset('editar','amount'),
})">
  <label from="editar">Elemento</label>
  <input v-model="editform.edit_task" type="text" name="editar"/> 
  <label from="amount" type="nunber">Quantidade</label>
  <input v-model="editform.edit_amount" type="text" name="amount"/> 
   <input v-model="editform.numbertask" type="text" name="numbertask" hidden /> 

  <button @click="submit">Salvar</button>
  </form>
  </div>
</Teleport>

<Link
                    
                    :href="route('logout')"
                    method="post"
                    class="h-4 p-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                    >Logout</Link
                >
  </div>
</template>
<style scoped>
.container-a{
  display:flex;
  height: 100%;
  width: 100%;
  justify-content: center;
  
}
.card{
  display:flex;
  flex-direction: column;
  justify-content: space-between;
  width: 50%;
  border-right: 5px solid rgb(173, 174, 250);;
  border-left: 5px solid rgb(173, 174, 250);;
  background-color:rgb(255, 253, 253);

}
.border-a{
  display: flex;
  align-items: flex-end;
  flex-wrap: wrap;
   border-bottom: 2px solid black;
   padding-left: 5px;
}
.border-b{
  margin: 2px;
}
.instruction{
  background-color:rgb(173, 174, 250);
}
.newtask{
   background-color:rgb(178, 188, 243);
}
.edit{
   background-color:rgb(178, 188, 243);
}
.delete{
   margin-right: 5px;
   margin-left: 5px;
 background-color:rgb(250, 0, 75);
}
.list{
  display: flex;
  align-items: flex-end;
  flex-wrap: wrap;
  flex-wrap: wrap;
}
.flex-grow{
  flex-grow: 3;
}
.save{
background-color: blue;
}
</style>