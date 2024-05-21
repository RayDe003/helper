import axios from 'axios';

import { apiHeaders, apiLink } from './index.js';

export const getDailyTasks = (date) => {
  let tasks = null;
  try {
    axios
      .get(apiLink(`by_date?date=${date}`), { headers: apiHeaders })
      .then((response) => (tasks = response.tasks));
  } catch (e) {
    return { tasks, e };
  }
  return { tasks };
};

export const getWeeksTasks = () => {
  let tasks = null;
  try {
    axios
      .get(apiLink('tasks/for_two_weeks'), { headers: apiHeaders })
      .then((response) => (tasks = response.tasks));
  } catch (e) {
    return { tasks, e };
  }
  return { tasks };
};

export const getMonthDays = (month) => {
  let days = null;
  try {
    axios
      .get(apiLink(`tasks/by_month?month=${month}`), { headers: apiHeaders })
      .then((response) => (days = response.days));
  } catch (e) {
    return { days, e };
  }
  return { days };
};

export const completeTask = (id) =>
  axios.patch(apiLink(`tasks/${id}/complete`), {}, { headers: apiHeaders });

export const patchDataTask = (id, data) =>
  axios.patch(apiLink(`users/update_task/${id}`), data, {
    headers: apiHeaders
  });

export const deleteTask = (id) =>
  axios.delete(apiLink(`users/delete_task/${id}`), { headers: apiHeaders });

export const createTask = (data) =>
  axios.post(apiLink('create_task'), data, { headers: apiHeaders });
