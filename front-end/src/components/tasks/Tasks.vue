<script setup>
import Task from "./Task.vue";
import { useTaskStore } from '../../stores/task'

const store = useTaskStore()

defineProps({
  tasks: Array,
  show: {
    type: Boolean,
    default: true,
  },
});

const { handleUpdatedTask, handleCompletedTask, handleRemovedTask } = store
</script>

<template>
  <div class="card mt-2" v-if="tasks.length > 0 && show">
    <ul class="list-group list-group-flush">
      <Task
        v-for="task in tasks"
        :task="task"
        :key="task.id"
        @updated="handleUpdatedTask"
        @completed="handleCompletedTask"
        @removed="handleRemovedTask"
      />
    </ul>
  </div>
</template>
