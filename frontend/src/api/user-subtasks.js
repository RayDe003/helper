import axios from 'axios';

import { apiHeaders, apiLink } from './index.js';

export const createSubTask = (taskId, data) =>
  axios.post(apiLink(`tasks/${taskId}/subtasks`), data, {
    headers: apiHeaders
  });

export const patchSubTask = (taskId, subTaskId, data) =>
  axios.patch(apiLink(`tasks/${taskId}/subtasks/${subTaskId}`), data, {
    headers: apiHeaders
  });

export const completeSubTask = (subTaskId) =>
  axios.patch(apiLink(`subtasks/${subTaskId}/complete`), {
    headers: apiHeaders
  });
