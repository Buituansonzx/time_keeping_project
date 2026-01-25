import React, { useState, useEffect } from "react";
import styled from "styled-components";
import { useNavigate } from "react-router-dom";
import Loader from "../../components/Loader";
import { useAuthContext } from "../../context/AuthContext";

const LoginForm = () => {
  const { sendOtp, verifyOtp } = useAuthContext();
  const navigate = useNavigate();

  const [step, setStep] = useState(1);
  const [email, setEmail] = useState("");
  const [otp, setOtp] = useState("");
  const [loading, setLoading] = useState(false);
  const [countdown, setCountdown] = useState(0);
  const [error, setError] = useState("");

  useEffect(() => {
    let timer;
    if (countdown > 0) {
      timer = setTimeout(() => setCountdown(countdown - 1), 1000);
    }
    return () => clearTimeout(timer);
  }, [countdown]);

  const handleSendOtp = async (e) => {
    e.preventDefault();
    if (!email.trim()) {
      setError("Vui lòng nhập email trước khi gửi OTP");
      return;
    }

    // validate format email (khuyến nghị)
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
      setError("Email không đúng định dạng");
      return;
    }
    setError("");
    setLoading(true);
    setOtp("");
    try {
      await sendOtp(email);
      setStep(2);
      setCountdown(60);
    } catch (error) {
      alert(error.message || "Failed to send OTP");
    } finally {
      setLoading(false);
    }
  };

  const handleVerifyOtp = async (e) => {
    e.preventDefault();
    setLoading(true);
    try {
      const res = await verifyOtp(email, otp);
      console.log("res:", res);
      if (!res.data?.access_token) {
        throw new Error("Invalid response");
      }

      navigate("/");
    } catch (err) {
      console.log(err);

      if (err.response?.status === 422) {
        setError(err.response.data?.message);
      } else {
        setError("Có lỗi xảy ra, vui lòng thử lại");
      }
    } finally {
      setLoading(false);
    }
  };

  return (
    <Wrapper>
      <div className="container bg-light">
        <form
          className={`form ${loading ? "is-loading" : ""}`}
          onSubmit={step === 1 ? handleSendOtp : handleVerifyOtp}
        >
          {loading && (
            <div className="loading-overlay">
              <Loader />
            </div>
          )}
          <p className="title">
            {step === 1 ? "Login with Email" : "Enter OTP"}
          </p>

          {step === 1 && (
            <>
              <input
                placeholder="Email"
                className="input"
                value={email}
                onChange={(e) => {
                  setEmail(e.target.value);
                  setError("");
                }}
              />

              {error && <p className="error-text">{error}</p>}
              <button className="btn" type="submit">
                Send OTP
              </button>
            </>
          )}

          {step === 2 && (
            <>
              <button
                type="button"
                className="back-btn"
                onClick={() => setStep(1)}
              >
                &#8592;
              </button>
              <p style={{ color: "wheat" }}>OTP đã gửi tới: {email}</p>
              <input
                placeholder="Enter OTP"
                className="input"
                type="text"
                value={otp}
                onChange={(e) => {
                  setOtp(e.target.value);
                  setError("");
                }}
              />
              {error && <p className="error-text">{error}</p>}
              <button className="btn" type="submit">
                Verify OTP
              </button>
              <button
                type="button"
                className="btn"
                style={{
                  marginTop: "0.5rem",
                  backgroundColor: "wheat",
                  color: "#000",
                }}
                disabled={countdown > 0}
                onClick={handleSendOtp}
              >
                {countdown > 0 ? `Resend OTP in ${countdown}s` : "Resend OTP"}
              </button>
            </>
          )}
        </form>
      </div>
    </Wrapper>
  );
};

const Wrapper = styled.div`
  ::selection {
    background-color: gray;
  }
  .form {
    position: relative;
  }

  /* Overlay phủ toàn bộ form */
  .loading-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.45); /* mờ phía sau */
    backdrop-filter: blur(3px); /* sang hơn */
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 10;
    border-radius: 12px;
  }

  /* Khi loading thì không cho tương tác phía sau */
  .form.is-loading {
    pointer-events: none;
  }

  /* Nhưng overlay vẫn tương tác được */
  .form.is-loading .loading-overlay {
    pointer-events: all;
  }
  .back-btn {
    position: absolute;
    top: 1rem;
    left: 1rem;
    background: wheat;
    border: none;
    color: #333;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    height: 2.5rem;
    width: 2.5rem;
    border-radius: 50%;
    font-size: 1.5rem;
    cursor: pointer;
    padding: 0;
    transition:
      background-color 0.25s ease,
      box-shadow 0.25s ease,
      transform 0.2s ease,
      color 0.2s ease;
  }
  .error-text {
    color: #ff6b6b;
    font-size: 0.85rem;
    margin-top: 0.25rem;
  }

  .input-error {
    border: 1px solid #ff6b6b;
    box-shadow: 0 0 0 2px rgba(255, 107, 107, 0.15);
  }
  /* Hover: sang, sạch */
  .back-btn:hover {
    background-color: #ffe8b3; /* sáng hơn wheat một chút */
    color: #6b4f00; /* vàng trầm, không chói */
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
    transform: translateY(-2px);
  }

  /* Active: cảm giác bấm thật */
  .back-btn:active {
    transform: translateY(0);
    box-shadow: 0 3px 8px rgba(0, 0, 0, 0.2);
  }
  .container {
    margin: 0 auto;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background: #121212;
  }

  .form {
    width: 400px;
    padding: 2rem;
    background-image: linear-gradient(to bottom, #424242, #212121);
    display: flex;
    flex-direction: column;
    align-items: center;
    border-radius: 0.5rem;
  }

  .title {
    color: wheat;
    margin-bottom: 2rem;
    font-size: 2rem;
    text-align: center;
  }

  .input {
    margin: 0.5rem 0;
    padding: 1rem 0.5rem;
    width: 100%;
    background-color: inherit;
    color: wheat;
    border: none;
    outline: none;
    border-bottom: 1px solid wheat;
    transition: all 400ms;
  }

  .input:hover,
  .input:focus {
    background-color: #424242;
    border-radius: 0.5rem;
  }

  .btn {
    height: 3rem;
    width: 100%;
    margin-top: 1rem;
    background-color: wheat;
    border-radius: 0.5rem;
    border: none;
    font-size: 1.2rem;
    transition: all 400ms;
    cursor: pointer;
  }

  .btn:hover:not(:disabled) {
    background-color: antiquewhite;
    box-shadow: none;
  }

  .btn:disabled {
    background-color: #a0a0a0 !important;
    cursor: not-allowed;
  }

  p {
    color: wheat;
    margin: 0.5rem 0;
    text-align: center;
  }
`;

export default LoginForm;
