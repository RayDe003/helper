import axios from 'axios';

import { apiHeaders, apiLink } from './index.js';

export const getDailyTasksRequest = async (date = null) =>
  await axios.get(
    apiLink(date ? `tasks/by_date?date=${date}` : 'tasks/by_date'),
    {
      headers: apiHeaders
    }
  );
export const getWeeksTasksRequest = () =>
  axios.get(apiLink('tasks/for_two_weeks'), { headers: apiHeaders });

export const getMonthDaysRequest = (month = null) =>
  axios.get(apiLink(`tasks/by_month${month ? `?month=${month}` : ''}`), {
    headers: apiHeaders
  });

export const completeTaskRequest = (id) =>
  axios.patch(apiLink(`tasks/${id}/complete`), {}, { headers: apiHeaders });

export const updateTaskRequest = (id, data) =>
  axios.patch(apiLink(`users/update_task/${id}`), data, {
    headers: apiHeaders
  });

export const deleteTaskRequest = (id) =>
  axios.delete(apiLink(`users/delete_task/${id}`), { headers: apiHeaders });

export const createTaskRequest = (data) =>
  axios.post(apiLink('create_task'), data, { headers: apiHeaders });
