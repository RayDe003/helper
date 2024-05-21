import axios from 'axios';

import { apiHeaders, apiLink } from './index.js';

export const getAllSystemTasks = () => {
  let tasks = null;
  try {
    axios
      .get(apiLink('system_tasks'), { headers: apiHeaders })
      .then((response) => (tasks = response.tasks));
  } catch (e) {
    return { tasks, e };
  }
  return { tasks };
};

export const getDailySystemTasks = () => {
  let tasks = null;
  try {
    axios
      .get(apiLink('system_tasks/today'), { headers: apiHeaders })
      .then((response) => (tasks = response.tasks));
  } catch (e) {
    return { tasks, e };
  }
  return { tasks };
};

export const getRandomTasks = () => {
  let tasks = null;
  try {
    axios
      .get(apiLink('system_tasks/random'), { headers: apiHeaders })
      .then((response) => (tasks = response.tasks));
  } catch (e) {
    return { tasks, e };
  }
  return { tasks };
};

export const randomizeSystemTask = (id) =>
  axios.post(
    apiLink('system_tasks/rerandom'),
    { random_task_id: id },
    { headers: apiHeaders }
  );

export const deleteSystemTask = () =>
  axios.delete(apiLink('system_tasks/rerandom'), { headers: apiHeaders });

export const completeSystemTask = (id) =>
  axios.patch(
    apiLink('system_tasks/rerandom'),
    { random_task_id: id },
    { headers: apiHeaders }
  );
