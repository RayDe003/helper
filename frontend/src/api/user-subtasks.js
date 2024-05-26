import axios from 'axios';

import { apiHeaders, apiLink } from './index.js';

export const createSubTaskRequest = (taskId, data) =>
  axios.post(apiLink(`tasks/${taskId}/subtasks`), data, {
    headers: apiHeaders
  });

export const patchSubTaskRequest = (taskId, subTaskId, data) =>
  axios.patch(apiLink(`tasks/${taskId}/subtasks/${subTaskId}`), data, {
    headers: apiHeaders
  });

export const completeSubTaskRequest = ({ taskId, subTaskId }) =>
  axios.patch(apiLink(`tasks/${taskId}/complete/${subTaskId}`), null, {
    headers: apiHeaders
  });
