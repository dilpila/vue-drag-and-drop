<template>
    <div class="row">
        <div class="col-2">
            <div class="form-group">
                <div
                    class="btn-group-vertical buttons"
                    role="group"
                    aria-label="Basic example"
                >
                </div>
            </div>
        </div>

        <div class="col-6">
            <h3>Draggable {{ draggingInfo }}</h3>
            <div class="row">
                <div class="col-6">
                    <input type="text" class="list-group-item" v-model="text">
                </div>
                <div class="col-6">
                    <button class="btn btn-secondary" @click="add">Add</button>
                </div>
            </div>

            <draggable
                :list="list"
                class="list-group"
                ghost-class="ghost"
                :move="checkMove"
                @start="dragging = true"
                @end="dragging = false"
            >
                <div
                    class="list-group-item"
                    v-for="element in list"
                    :key="element.id"
                >
                    <div @drop="dropEvent($event,1)" class="row">

                        <p style="width: 75%">{{ element.title }} </p>
                        <button class="btn btn-secondary" @click="remove(element.id)">delete</button>
                    </div>
                </div>
            </draggable>
        </div>

        <!--        <raw-display-component class="col-3" :value="list" title="List" />-->
    </div>
</template>

<script>
import draggable from "vuedraggable";
import axios from 'axios'

let id = 1;
export default {
    name: "simple",
    display: "Simple",
    order: 0,
    components: {
        draggable
    },
    data() {
        return {
            enabled: true,
            text: '',
            list: [
                // {id: 1, title: "ram"},
                // {id: 2, title: "shyam"},
                // {id: 3, title: "hari"}
            ],
            updatedDataList: [],
            dragging: false,
        };
    },
    computed: {
        draggingInfo() {
            return this.dragging ? "draggging" : "";
        }
    },
    mounted() {
        this.getTask();
    },
    methods: {
        add() {
            axios.post('api/task/create', {
                title: this.text
            }).then((res) => {
                this.text = '';
                this.getTask();
            })
            // this.list.push({name: this.text, id: id++});
        },

        checkMove: function (e) {
            this.updatedDataList = e.relatedContext.list;
            this.updatedDataList = this.updatedDataList.map((res,i) => {
                res.order_new = i;
                return res;
            });

        },
        remove(id) {
            axios.get('api/task/delete/' + id).then((res) => {
                this.getTask();
            });

        },
        dropEvent:function (e) {
            this.updateDragDrop()
        },

        getTask() {
            axios.get('api/task').then((res) => {
                // console.log(res.data.data.tasks)
                this.list = res.data.data.tasks;
            })
        },
        updateDragDrop() {
            axios.post('api/task/update/drag', {
                result: this.updatedDataList,
            }).then((res) => {
            });

        }
    }
};
</script>
<style scoped>
.buttons {
    margin-top: 35px;
}

.ghost {
    opacity: 0.5;
    background: #c8ebfb;
}
</style>
