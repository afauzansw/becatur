'use client';

import { useState, forwardRef, useMemo } from 'react';
import { useMask } from '@react-input/mask';
import type { TextInputDOMProps } from '@react-types/shared';
import { IconEye, IconEyeClosed } from 'justd-icons';
import {
  Button as ButtonPrimitive,
  TextField as TextFieldPrimitive,
  type TextFieldProps as TextFieldPrimitiveProps
} from 'react-aria-components';
import { twJoin } from 'tailwind-merge';

import type { FieldProps } from './field';
import { Description, FieldError, FieldGroup, Input, Label } from './field';
import { Loader } from './loader';
import { composeTailwindRenderProps } from './primitive';
import { useNumberFormat } from '@react-input/number-format';

type InputType = Exclude<TextInputDOMProps['type'], 'password'>;

interface BaseTextFieldProps extends TextFieldPrimitiveProps, FieldProps {
  prefix?: React.ReactNode;
  suffix?: React.ReactNode;
  isPending?: boolean;
  className?: string;
  step?: string;
  pattern?: string;
  mask?: { mask: string, replacement?: Record<string, RegExp> };
}

interface RevealableTextFieldProps extends BaseTextFieldProps {
  isRevealable: true;
  type: 'password';
}

interface NonRevealableTextFieldProps extends BaseTextFieldProps {
  isRevealable?: never;
  type?: InputType;
}

type TextFieldProps = RevealableTextFieldProps | NonRevealableTextFieldProps;

const TextField = forwardRef<HTMLInputElement, TextFieldProps>(function TextField(
  {
    placeholder,
    label,
    description,
    errorMessage,
    prefix,
    suffix,
    isPending,
    className,
    isRevealable,
    type,
    isRequired,
    mask,
    ...props
  },
  forwardedRef
) {
  const [isPasswordVisible, setIsPasswordVisible] = useState(false);
  const inputType = isRevealable ? (isPasswordVisible ? 'text' : 'password') : type;

  const numberFormat = mask?.mask === 'thousand' ? useNumberFormat({ locales: 'id' }) : null;
  const otherMask = mask && mask.mask !== 'thousand' ? useMask(mask) : null;

  const maskRef = useMemo(() => {
    if (!mask) return undefined;

    if (mask.mask === 'thousand') {
      return numberFormat;
    } else {
      return otherMask;
    }
  }, [mask, numberFormat, otherMask]);


  const handleTogglePasswordVisibility = () => {
    setIsPasswordVisible((prev) => !prev);
  };

  return (
    <TextFieldPrimitive
      type={inputType}
      {...props}
      className={composeTailwindRenderProps(className, 'group flex flex-col gap-y-1.5')}
    >
      {label && (
        <Label className='capitalize'>
          {label}
          {isRequired && <span className="ml-0.5 text-red-500 text-sm">*</span>}
        </Label>
      )}
      <FieldGroup
        isInvalid={!!errorMessage}
        isDisabled={props.isDisabled}
        className={twJoin(
          '**:[button]:size-7 **:[button]:shrink-0 **:[button]:p-0',
          '[&>[data-slot=suffix]>button]:mr-[calc(var(--spacing)*-1.15)] [&>[data-slot=suffix]>button]:rounded-md [&>[data-slot=suffix]>button]:data-focus-visible:outline-1 [&>[data-slot=suffix]>button]:data-focus-visible:outline-offset-1',
          '[&>[data-slot=prefix]>button]:mr-[calc(var(--spacing)*-1.15)] [&>[data-slot=prefix]>button]:rounded-md [&>[data-slot=prefix]>button]:data-focus-visible:outline-1 [&>[data-slot=prefix]>button]:data-focus-visible:outline-offset-1'
        )}
        data-loading={isPending ? 'true' : undefined}
      >
        {prefix ? (
          <span data-slot="prefix" className="atrs x2e2">
            {prefix}
          </span>
        ) : null}

        <Input
          ref={(node) => {
            // Only apply mask ref if mask is enabled
            if (mask && maskRef) {
              (maskRef as React.MutableRefObject<HTMLInputElement | null>).current = node;
            }
            // Handle forwarded ref
            if (typeof forwardedRef === 'function') {
              forwardedRef(node);
            } else if (forwardedRef) {
              forwardedRef.current = node;
            }
          }}
          placeholder={placeholder}
          step={props.step}
          pattern={props.pattern}
        />

        {isRevealable ? (
          <ButtonPrimitive
            type="button"
            aria-label="Toggle password visibility"
            onPress={handleTogglePasswordVisibility}
            className="relative mr-1 grid shrink-0 place-content-center rounded-sm border-transparent outline-hidden data-focus-visible:*:data-[slot=icon]:text-primary *:data-[slot=icon]:text-muted-fg"
          >
            {isPasswordVisible ? <IconEyeClosed /> : <IconEye />}
          </ButtonPrimitive>
        ) : isPending ? (
          <Loader variant="spin" data-slot="suffix" />
        ) : suffix ? (
          <span data-slot="suffix">{suffix}</span>
        ) : null}
      </FieldGroup>
      {description && <Description>{description}</Description>}
      <FieldError>{errorMessage}</FieldError>
    </TextFieldPrimitive>
  );
});

export { TextField, TextFieldPrimitive, type TextFieldProps };
