import axios from "axios";
import { API_BASE_URL, TIMEOUT } from "../config/config";
import { getFingerprint } from "../utils/fingerprint/fingerprint.util";

const api = axios.create({
  baseURL: API_BASE_URL,
  timeout: TIMEOUT,
});

//Thêm fingerprint va platform vao header cua moi request
api.interceptors.request.use(
  async (config) => {
    const fingerprint = await getFingerprint();

    config.headers["X-Device-Fingerprint"] = fingerprint;
    config.headers["X-Platform"] = "web";

    return config;
  },
  (error) => Promise.reject(error),
);

export const sendOtpAPI = async (email) => {
  const response = await api.post("/auth/login", { email });
  return response.data; 
};

export const verifyOtpAPI = async (email, otp) => {
  const response = await api.post("/auth/login", { email, otp });
  localStorage.setItem("token", response.data.data.access_token);
  localStorage.setItem("user", JSON.stringify(response.data.data.user));
  return response.data; 
};