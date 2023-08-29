
<template >
<div class="container-a">
<div class="card">
<h5  class="instruction">
Essa ferramenta funciona armazenando sua lista no armazenamento local do seu navegador. caso queira salvalas para utilizar em outros locais crie uma conta<a :href="route('register')"
 class=" instruction ml-1 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
>Criar Conta</a> ou entre em sua conta  <a
                    :href="route('login')"
                    class=" font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                    >Entrar</a
                >
</h5>
<div >
<h1>
Lista 
</h1>
<br>
<ul >
<li v-for="(task, numbertask) in tasks" :key="numbertask"  :id="'a'+task['numbertask']" class="border-a">
  <div class="flex-grow">{{ task["task"]}} Quantidade:{{ task["amount"]}}</div>
  <button class="edit" @click.prevent="edit(id='a'+task['numbertask'])" >Editar</button>
  <button class="delete" @click.prevent="destroy(id=task['numbertask'])">Deletar</button>
</li>
</ul>
<br>
</div>
<div>
<h3 class="newtask">Nova Elemento</h3>
<form class="newtask">
<label from="newtask">Tarefa</label>
<input  v-model="newtask" name="newtask" type="text"/>
<label from="amount" type="nunber">Quantidade</label>
<input v-model="newtask_amount"  name="amount"/>
<br>
<button class="save" @click="submit">Salvar</button>
<button  class="delete" @click="clear">Limpar Tudo</button>
</form>
</div>
<Teleport  v-if="teleport_id" :to="`#${teleport_id}`">
  <div class="border-b">
  <label from="newtask">Elemento</label>
  <input v-model="edit_task" type="text" name="editar"/> 
  <label from="amount" type="nunber">Quantidade</label>
  <input v-model="edit_amount" type="text" name="editar"/> 
  <button  @click="save">Salvar</button>
  </div>
</Teleport>
</div>
  <a :href="route('register')"
 class=" h-4 p-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
>Criar Conta</a>
<a :href="route('login')"
  class="h-4 p-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
  >Entrar</a>

</div>
</template>
<style scoped>
.flex{
  display: flex;
}
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
<script >

export default {
    data() {
    return {
      tasks:{},
      edit_task:'',
      edit_amount:'',
      teleport_id:"",
      newtask:"",
      newtask_amount:"",
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
        amount:this.edit_amount,
        numbertask:this.teleport_id.replace('a','')
      }
      console.log(this.teleport_id.replace('a',''))
       localStorage.setItem(this.teleport_id.replace('a',''), JSON.stringify(taskObject))
      },
      destroy(id){
        
     localStorage.removeItem(id);
     

    },
    submit() {
      const taskObject = {
        task: this.newtask,
        amount:this.newtask_amount,
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