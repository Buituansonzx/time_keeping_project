import React, { useContext, useEffect, useState, createContext } from "react";
import { sendOtpAPI, verifyOtpAPI } from "../services/authServices";

const AuthContext = createContext();

export const AuthProvider = ({ children }) => {
  const [user, setUser] = useState(null);

  // load user từ localStorage khi app start
  useEffect(() => {
    const storedUser = localStorage.getItem("user");
    if (storedUser) setUser(JSON.parse(storedUser));
  }, []);

  // Step 1: gửi OTP lên email
  const sendOtp = async (email) => {
    return await sendOtpAPI(email);
  };

  const verifyOtp = async (email, otp) => {
    const userData = await verifyOtpAPI(email, otp);
    console.log("userData:", userData);
    setUser(userData);
    return userData;
  };

  const logout = () => {
    localStorage.removeItem("token");
    localStorage.removeItem("user");
    setUser(null);
  };

  return (
    <AuthContext.Provider value={{ user, sendOtp, verifyOtp, logout }}>
      {children}
    </AuthContext.Provider>
  );
};

// hook tiện dụng
export const useAuthContext = () => {
  const context = useContext(AuthContext);
  if (!context)
    throw new Error("useAuthContext must be used within an AuthProvider");
  return context;
};
