import axios from 'axios';
import { LOGIN } from 'constants/apiPaths';

axios.defaults.baseURL = process.env.SERVER_URL;
axios.defaults.headers.common = {
  Accept: 'application/json',
  'Content-Type': 'application/json',
};

export const signIn = (params) => {
  return axios.post(`${LOGIN}/`, {
    ...params,
  }).then(({ data }) => data);
};
